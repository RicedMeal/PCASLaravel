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
        Schema::create('requisition_items', function (Blueprint $table) {
            #$table->id();
            $table->string('ris_no')->primary();
            $table->integer('stock_no');
            $table->unsignedBigInteger('requisition_id');
            $table->string('unit');
            $table->string('description');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('ris_no')->references('ris_no')->on('requisition')->onUpdate('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisition_items');
    }
};
