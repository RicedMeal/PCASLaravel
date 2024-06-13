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
        Schema::create('purchase_request_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('market_studies_id')->nullable();
            $table->json('market_studies_items_id')->nullable(); // Corrected column name
            $table->string('pr_no')->nullable();
            $table->date('date');
            $table->string('section')->nullable();
            $table->string('sai_no')->nullable();
            $table->string('bus_no')->nullable();
            //$table->double('total');
            $table->string('delivery_duration');
            $table->string('purpose');
            $table->string('recommended_by_name');
            $table->string('recommended_by_designation');
            $table->string('approved_by_name');
            $table->string('approved_by_designation');
            $table->timestamps();
            $table->foreign('market_studies_id')->references('id')->on('market_studies')->onUpdate('cascade');
            //$table->foreign('market_studies_items_id')->references('id')->on('market_studies_items')->onUpdate('cascade'); // Corrected foreign key
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_request_form');
    }
};
