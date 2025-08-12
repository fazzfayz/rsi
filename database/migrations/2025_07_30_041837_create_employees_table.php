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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique(); // Nomor ID Karyawan
            $table->string('name'); // Nama Lengkap
            $table->string('position'); // Jabatan
            $table->string('department'); // Departemen
            $table->string('email')->unique(); // Email
            $table->string('phone'); // Nomor Telepon
            $table->text('address'); // Alamat
            $table->date('hire_date'); // Tanggal Bergabung
            $table->decimal('salary', 12, 2); // Gaji
            $table->enum('status', ['active', 'inactive', 'terminated'])->default('active'); // Status Karyawan
            $table->string('photo')->nullable(); // Foto Karyawan
            $table->text('notes')->nullable(); // Catatan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
