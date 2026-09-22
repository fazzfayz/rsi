<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_images', function (Blueprint $table) {
            $table->boolean('is_logo')->default(false)->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('service_images', function (Blueprint $table) {
            $table->dropColumn('is_logo');
        });
    }
};

