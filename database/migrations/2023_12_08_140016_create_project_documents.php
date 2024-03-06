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
        Schema::create('project_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->binary('purchase_request')->nullable();
            $table->binary('price_quotation')->nullable();
            $table->binary('abstract_of_canvass')->nullable();
            $table->binary('material_and_cost_estimates')->nullable();
            $table->binary('budget_utilization_request')->nullable();
            $table->binary('project_initiation_proposal')->nullable();
            $table->binary('annual_procurement_plan')->nullable();
            $table->binary('purchase_order')->nullable();
            $table->binary('market_study')->nullable();
            $table->binary('certificate_of_fund_allotment')->nullable();
            $table->binary('complete_staff_work')->nullable();
            $table->binary('accomplishment_report')->nullable();
            $table->binary('supplementary_document')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplementary_documents');
    }
};
