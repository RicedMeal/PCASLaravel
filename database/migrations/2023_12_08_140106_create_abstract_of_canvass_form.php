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
        Schema::create('abstract_of_canvass_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->float('approved_budget_contract')->nullable();
            $table->string('supplier_company_name');
            $table->string('supplier_address');
            $table->string('supplier_contact_no');
            $table->float('sub_total_each_supplier')->default(0.00);
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });

        Schema::create('abstract_of_canvass_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('abstract_of_canvass_form_id');
            $table->integer('item');
            $table->string('particulars');
            $table->integer('quantity');
            $table->string('unit');
            $table->float('abc_in_table')->nullable();
            $table->float('unit_price_each_supplier');
            $table->float('amount_each_supplier');
            $table->float('unit_price_average')->default(0.00);
            $table->float('amount_average')->default(0.00);
            $table->timestamps();
            $table->foreign('abstract_of_canvass_form_id')->references('id')->on('abstract_of_canvass_form')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abstract_of_canvass_form');
        Schema::dropIfExists('abstract_of_canvass_items');
    }
};
