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
        Schema::create('stock_card', function (Blueprint $table) {
            $table->id();
            $table->string('entity_name')->nullable();
            $table->string('fund_cluster')->nullable();
            $table->string('item_code');
            $table->string('item_description');
            $table->string('unit');
            $table->string('stock_no')->nullable();
            $table->string('reorder_point')->nullable();
            $table->timestamps();
        });

        Schema::create('stock_card_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_card_id');
            $table->string('date');
            $table->string('reference');
            $table->integer('receipt_quantity');
            $table->integer('issue_quantity');
            $table->string('issue_office');
            $table->integer('balance_quantity');
            $table->string('no_of_days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_card');
        Schema::dropIfExists('stock_card_list');
    }
};
