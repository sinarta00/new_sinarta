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
        Schema::table('instructor_applications', function (Blueprint $table) {
            //
               $table->text('usulan_kegiatan_dan_materi')->nullable()->after('motivation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instructor_applications', function (Blueprint $table) {
            //
             $table->dropColumn('usulan_kegiatan_dan_materi');
        });
    }
};
