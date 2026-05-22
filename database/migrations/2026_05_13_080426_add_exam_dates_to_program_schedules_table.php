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
        Schema::table('program_schedules', function (Blueprint $table) {
            $table->date('exam_date_seminar')->nullable()->after('end_date');
            $table->date('exam_date_teori')->nullable()->after('exam_date_seminar');
            $table->date('exam_date_assesment')->nullable()->after('exam_date_teori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('program_schedules', function (Blueprint $table) {
            $table->dropColumn([
                'exam_date_seminar',
                'exam_date_teori',
                'exam_date_assesment',
            ]);
        });
    }
};
