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
        Schema::create('market_studies_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('supplier_address');
            $table->string('supplier_contact');
            $table->float('sub_total')->nullable();
            $table->timestamps();
        });

        Schema::create('ms_supplier_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_studies_items_id');
            $table->unsignedBigInteger('market_studies_supplier_id')->nullable();
            $table->float('unit_price');
            $table->float('amount_per_supplier');
            $table->timestamps();
            $table->foreign('market_studies_items_id')->references('id')->on('market_studies_items')->onUpdate('cascade');
            $table->foreign('market_studies_supplier_id')->references('id')->on('market_studies_supplier')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_studies_supplier');
        Schema::dropIfExists('ms_supplier_items');
    }
};
