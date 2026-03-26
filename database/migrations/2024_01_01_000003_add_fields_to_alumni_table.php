<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->boolean('is_working')->default(false)->after('training_id');
            $table->boolean('has_skp')->default(false)->after('is_working');
            $table->date('skp_expired_date')->nullable()->after('has_skp');
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn(['is_working', 'has_skp', 'skp_expired_date']);
        });
    }
};
