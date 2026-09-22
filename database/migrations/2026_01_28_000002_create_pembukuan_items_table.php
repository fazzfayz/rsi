<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembukuan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembukuan_id')->constrained('pembukuans')->onDelete('cascade');
            $table->string('nama_barang');
            $table->decimal('quantity', 12, 2)->default(1);
            $table->decimal('harga_barang', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembukuan_items');
    }
};
