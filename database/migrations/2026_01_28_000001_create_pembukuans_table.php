<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembukuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_project');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->decimal('total_jumlah', 15, 2)->default(0);
            $table->decimal('income', 15, 2)->default(0);
            $table->decimal('selisih', 15, 2)->default(0);
            $table->string('selisih_status')->nullable(); // 'profit' | 'loss'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembukuans');
    }
};
