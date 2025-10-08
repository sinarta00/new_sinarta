<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page_url'); // URL yang dikunjungi
            $table->string('page_name')->nullable(); // Nama halaman (Home, About, dll)
            $table->string('ip_address')->nullable(); // IP visitor
            $table->string('user_agent')->nullable(); // Browser info
            $table->string('device_type')->nullable(); // mobile/desktop
            $table->string('referer')->nullable(); // Dari mana datangnya
            $table->timestamp('visited_at');
            $table->timestamps();
            
            // Index untuk query cepat
            $table->index('page_url');
            $table->index('visited_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};