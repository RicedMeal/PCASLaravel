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
    { #jaime table PSO Supplies
        Schema::create('supplies', function (Blueprint $table) {
            $table->string('stock_no', 191)->nullable();
            $table->string('description', 191)->nullable();
            $table->string('unit', 191)->nullable();
            $table->integer('delivered')->nullable();
            $table->integer('issued')->nullable();
            $table->integer('balance_after')->nullable();
            $table->string('status', 191)->nullable();
            $table->date('date_issuance')->nullable();
            $table->string('requesting_office', 191)->nullable();
            $table->string('report_no', 191)->nullable();
            $table->string('ris_no', 191)->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('actual_delivery_date')->nullable();
            $table->date('acceptance_date')->nullable();
            $table->string('iar_no', 191)->nullable();
            $table->string('item_no', 15)->nullable();
            $table->string('dr_no', 191)->nullable();
            $table->string('check_no', 191)->nullable();
            $table->string('po_no', 191)->nullable();
            $table->date('po_date')->nullable();
            $table->double('po_amount', 8, 2)->nullable();
            $table->string('pr_no', 191)->primary();
            $table->double('price_per_purchase_request', 8, 2)->nullable();
            $table->string('bur', 191)->nullable();
            $table->string('remarks', 191)->nullable();
            $table->timestamps();
            $table->boolean('added')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
