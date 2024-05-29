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
        Schema::create('bur', function (Blueprint $table) {
                $table->id('bur_no');
                $table->date('date');
                $table->string('payee', 255);
                $table->string('office', 255);
                $table->string('address', 255);
                $table->string('responsibility_center', 255);
                $table->string('account_code', 255);
                $table->string('particulars', 255);
                $table->decimal('amount', 10, 2);
                $table->string('disbursement_voucher', 255);
                $table->string('certificate_of_funds_availability', 255);
                $table->string('purchase_order', 255);
                $table->string('purchase_request', 255);
                $table->string('completed_staff_work', 255);
                $table->timestamps();  // This will add both 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bur');
    }
};
