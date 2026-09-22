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
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        
        // TAMBAHAN 1: Kolom contact_person
        $table->string('contact_person')->nullable();
        
        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->text('address');
        $table->text('description')->nullable();
        
        // Pastikan join_year ada
        $table->integer('join_year'); 
        
        // TAMBAHAN 2: Kolom status dengan default value
        $table->string('status')->default('active'); 
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
