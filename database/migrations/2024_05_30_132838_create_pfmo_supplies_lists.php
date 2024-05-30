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
        Schema::create('pfmo_supplies_list', function (Blueprint $table) {
            //$table->id();
            $table->unsignedBigInteger('pfmo_supplies_id');
            $table->string('stock_no');
            $table->string('unit');
            $table->string('description');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('pfmo_supplies_id')->references('id')->on('pfmo_supplies')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pfmo_supplies_lists');
    }
};
