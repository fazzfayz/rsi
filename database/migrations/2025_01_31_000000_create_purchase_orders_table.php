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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->unique();
            $table->date('po_date');
            $table->string('ref_number')->nullable();
            $table->foreignId('vendor_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->string('vendor_name');
            $table->text('vendor_address');
            $table->string('vendor_email')->nullable();
            $table->string('vendor_contact_person')->nullable();
            $table->string('ship_to_company');
            $table->text('ship_to_address');
            $table->string('attention_to')->nullable();
            $table->string('attention_name')->nullable();
            $table->decimal('subtotal', 15, 2);
            $table->decimal('vat_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);
            $table->text('notes')->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'cancelled'])->default('draft');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
}; 