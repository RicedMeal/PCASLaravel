<?php

use Brick\Math\BigInteger;
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
        Schema::create('purchase_request_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('pr_no')->unique();
            $table->date('date')->index();
            $table->string('section')->nullable();
            $table->string('sai_no')->nullable();
            $table->string('bus_no')->nullable();
            $table->double('total');
            $table->string('delivery_duration');
            $table->string('purpose');
            $table->string('recommended_by_name');
            $table->string('recommended_by_designation');
            $table->string('approved_by_name');
            $table->string('approved_by_designation');
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('purchase_request_items', function (Blueprint $table) {
            $table->id();
            $table->integer('item_no');
            $table->unsignedBigInteger('purchase_request_form_id');
            $table->string('unit');
            $table->string('item_description');
            $table->Integer('quantity');
            $table->double('estimate_unit_cost');
            $table->double('estimate_cost');
            $table->timestamps();
            $table->foreign('purchase_request_form_id')->references('id')->on('purchase_request_form')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_request_form');
        Schema::dropIfExists('purchase_request_items');
    }
};
