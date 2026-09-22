<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('delivery_orders', function (Blueprint $table) {
            $table->foreignId('carrier_employee_id')->nullable()->after('driver_name')->constrained('employees')->onDelete('set null');
            $table->foreignId('signer_employee_id')->nullable()->after('carrier_employee_id')->constrained('employees')->onDelete('set null');
            $table->string('receiver_name')->nullable()->after('signer_employee_id');
        });
    }

    public function down(): void
    {
        Schema::table('delivery_orders', function (Blueprint $table) {
            $table->dropForeign(['carrier_employee_id']);
            $table->dropForeign(['signer_employee_id']);
            $table->dropColumn(['carrier_employee_id', 'signer_employee_id', 'receiver_name']);
        });
    }
};
