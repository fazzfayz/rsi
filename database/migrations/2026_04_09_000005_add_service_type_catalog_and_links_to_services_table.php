<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('service_type')->default('managed_service')->after('title');
            $table->string('catalog_file')->nullable()->after('image');
            $table->json('extra_links')->nullable()->after('catalog_file');
        });

        DB::table('services')
            ->whereNull('service_type')
            ->update(['service_type' => 'managed_service']);
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['service_type', 'catalog_file', 'extra_links']);
        });
    }
};

