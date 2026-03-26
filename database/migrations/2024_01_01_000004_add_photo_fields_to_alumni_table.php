<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->string('work_photo')->nullable()->after('skp_expired_date');
            $table->boolean('allow_publish_photo')->default(false)->after('work_photo');
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn(['work_photo', 'allow_publish_photo']);
        });
    }
};
