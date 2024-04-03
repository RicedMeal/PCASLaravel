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
        Schema::create('material_cost_estimates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('location');
            $table->double('total');
            $table->string('prepared_by');
            $table->string('checked_by');
            $table->string('prepared_by_designation');
            $table->string('checked_by_designation');
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('material_cost_estimates_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_cost_estimates_id');
            $table->string('item_no');
            $table->string('description');
            $table->Integer('quantity');
            $table->string('unit');
            $table->double('unit_cost');
            $table->double('amount');
            $table->timestamps();
            $table->foreign('material_cost_estimates_id')->references('id')->on('material_cost_estimates')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_cost_estimates');
        Schema::dropIfExists('material_cost_estimate_items');
    }

};
