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
             // Hapus kolom price & discount dari programs (pindah ke variants)
            Schema::table('programs', function (Blueprint $table) {
                $table->dropColumn(['price', 'discount']);
            });

            // Buat tabel baru
            Schema::create('program_variants', function (Blueprint $table) {
                $table->id();
                $table->foreignId('program_id')->constrained()->cascadeOnDelete();
                $table->string('name')->nullable(); // NULL = tidak berjenis
                $table->decimal('price', 10, 2);
                $table->integer('discount')->nullable(); // %
                $table->string('registration_link')->nullable();
                $table->string('duration')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('order')->default(0);
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
          Schema::dropIfExists('program_variants');
            Schema::table('programs', function (Blueprint $table) {
                $table->decimal('price', 10, 2)->nullable();
                $table->integer('discount')->nullable();
            });
    }
};
