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
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->string('do_number')->unique(); // Nomor Surat Jalan
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Relasi ke Client
            $table->date('delivery_date'); // Tanggal Pengiriman
            $table->string('vehicle_no')->nullable(); // No Kendaraan
            $table->string('driver_name')->nullable(); // Nama Sopir
            $table->text('shipping_address')->nullable(); // Alamat Pengiriman
            $table->string('attention_to')->nullable(); // UP
            $table->text('notes')->nullable(); // Catatan
            $table->string('pdf_path')->nullable(); // Path file PDF
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};