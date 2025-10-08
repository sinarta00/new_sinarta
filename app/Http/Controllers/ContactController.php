<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Rules\RecaptchaRule;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function store(Request $request)
    {
        try {
            // Validasi input termasuk reCAPTCHA
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|max:20',
                'program' => 'nullable|max:255',
                'message' => 'required',
                'recaptcha_token' => ['required', new RecaptchaRule],
            ], [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'phone.required' => 'No. telepon wajib diisi',
                'message.required' => 'Pesan wajib diisi',
                'recaptcha_token.required' => 'Verifikasi reCAPTCHA diperlukan',
            ]);
            
            // Hapus recaptcha_token sebelum simpan ke database
            unset($validated['recaptcha_token']);
            
            // Simpan ke database
            ContactMessage::create($validated);
            
            return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error (termasuk reCAPTCHA gagal)
            return redirect()->back()
                ->withInput()
                ->withErrors($e->validator);
                
        } catch (\Exception $e) {
            // Error lainnya
            \Log::error('Contact form error: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi atau hubungi kami via WhatsApp.');
        }
    }
}