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
        Schema::create('assignment_letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_number')->unique(); // Nomor surat
            $table->foreignId('signer_id')->constrained('employees'); // ID karyawan yang menandatangani
            $table->foreignId('assigned_to_id')->constrained('employees'); // ID karyawan yang diberi tugas
            $table->text('assignment_description'); // Deskripsi tugas
            $table->date('assignment_date'); // Tanggal surat
            $table->date('start_date')->nullable(); // Tanggal mulai tugas
            $table->date('end_date')->nullable(); // Tanggal selesai tugas
            $table->string('location')->nullable(); // Lokasi tugas
            $table->text('additional_notes')->nullable(); // Catatan tambahan
            $table->enum('status', ['draft', 'active', 'completed', 'cancelled'])->default('draft');
            $table->string('pdf_path')->nullable(); // Path file PDF yang di-generate
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_letters');
    }
};
