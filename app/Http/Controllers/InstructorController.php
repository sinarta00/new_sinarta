<?php

namespace App\Http\Controllers;

use App\Models\InstructorApplication;
use App\Models\InstructorPageContent;
use App\Models\InstructorGallery; // TAMBAHKAN INI - PENTING!
use App\Http\Requests\InstructorApplicationRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class InstructorController extends Controller
{
    public function index()
    {
        // Get all page content
        $hero = InstructorPageContent::getContent('hero');
        $programs = InstructorPageContent::getContent('programs');
        $requirements = InstructorPageContent::getContent('requirements');
        $benefits = InstructorPageContent::getContent('benefits');
        $contact = InstructorPageContent::getContent('contact');
        
        // Get gallery images
        $galleryImages = InstructorGallery::active()
            ->ordered()
            ->get();

        return view('instructor.index', compact(
            'hero',
            'programs',
            'requirements',
            'benefits',
            'contact',
            'galleryImages'
        ));
    }

    public function store(InstructorApplicationRequest $request)
    {
        // dd($request->all());
        // Verify reCAPTCHA
        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->recaptcha_token,
        ]);

        $recaptchaResult = $recaptchaResponse->json();

        if (!$recaptchaResult['success'] || $recaptchaResult['score'] < 0.5) {
            return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.'])->withInput();
        }

        // Prepare data
        $data = $request->except(['cv_file', 'certificate_files', 'recaptcha_token']);

        // Upload CV
        if ($request->hasFile('cv_file')) {
            $data['cv_path'] = $request->file('cv_file')->store('instructor-applications/cv', 'public');
        }

        // Simpan file
        if ($request->hasFile('diploma_file')) {
            $data['diploma_file'] = $request->file('diploma_file')->store('instructor-applications/ijazah', 'public');
            // Simpan $diplomaPath ke database
        }

        // Upload Multiple Certificates
        $certificatePaths = [];
        if ($request->hasFile('certificate_files')) {
            foreach ($request->file('certificate_files') as $file) {
                $certificatePaths[] = $file->store('instructor-applications/certificates', 'public');
            }
        }
        $data['certificate_paths'] = $certificatePaths;

        // Add tracking
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->userAgent();
        $data['status'] = 'pending';

        // Create application
        InstructorApplication::create($data);

        return back()->with('success', true);
    }
}