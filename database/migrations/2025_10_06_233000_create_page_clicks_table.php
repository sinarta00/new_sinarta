<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_clicks', function (Blueprint $table) {
            $table->id();
            $table->string('click_type'); // whatsapp, program, service, dll
            $table->string('click_label')->nullable(); // Label detail (nama program, dll)
            $table->string('page_url'); // Di halaman mana di-klik
            $table->string('ip_address')->nullable();
            $table->timestamp('clicked_at');
            $table->timestamps();
            
            // Index
            $table->index('click_type');
            $table->index('clicked_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_clicks');
    }
};