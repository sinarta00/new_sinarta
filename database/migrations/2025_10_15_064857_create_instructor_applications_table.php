<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instructor_applications', function (Blueprint $table) {
            $table->id();
            
            // Data Diri
            $table->string('full_name');
            $table->string('city');
            $table->string('whatsapp');
            $table->string('email');
            
            // Bidang Keahlian (stored as JSON array)
            $table->json('expertise_fields');
            $table->text('other_expertise')->nullable(); // Jika pilih "Topik Lainnya"
            
            // Upload Documents
            $table->string('cv_path')->nullable();
            $table->json('certificate_paths')->nullable(); // Multiple files
            
            // Kesediaan
            $table->json('availability_time'); // weekday, weekend
            $table->json('availability_programs'); // array of programs
            
            // Motivasi
            $table->text('motivation');
            
            // Status & Admin
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            
            // Tracking
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_applications');
    }
};