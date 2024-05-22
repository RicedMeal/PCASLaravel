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
        Schema::create('purchase_request_items', function (Blueprint $table) {
            #$table->id();
            $table->string('pr_no')->primary();
            $table->integer('item_no');
            $table->unsignedBigInteger('purchase_request_form_id');
            $table->string('unit');
            $table->string('item_description');
            $table->Integer('quantity');
            $table->double('estimate_unit_cost');
            $table->double('estimate_cost');
            $table->timestamps();
            $table->foreign('pr_no')->references('pr_no')->on('purchase_request_form')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_request_items');
    }
};
