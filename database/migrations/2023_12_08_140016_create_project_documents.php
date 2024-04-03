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
            $table->string('purchase_request_file_name')->nullable();
            $table->binary('purchase_request_number')->nullable();
            $table->binary('purchase_request_number_file_name')->nullable();
            $table->binary('price_quotation')->nullable();
            $table->string('price_quotation_file_name')->nullable();
            $table->binary('abstract_of_canvass')->nullable();
            $table->string('abstract_of_canvass_file_name')->nullable();
            $table->binary('material_and_cost_estimates')->nullable();
            $table->string('material_and_cost_estimates_file_name')->nullable();
            $table->binary('budget_utilization_request')->nullable();
            $table->string('budget_utilization_request_file_name')->nullable();
            $table->binary('project_initiation_proposal')->nullable();
            $table->string('project_initiation_proposal_file_name')->nullable();
            $table->binary('annual_procurement_plan')->nullable();
            $table->string('annual_procurement_plan_file_name')->nullable();
            $table->binary('purchase_order')->nullable();
            $table->string('purchase_order_file_name')->nullable();
            $table->binary('market_study')->nullable();
            $table->string('market_study_file_name')->nullable();
            $table->binary('certificate_of_fund_allotment')->nullable();
            $table->string('certificate_of_fund_allotment_file_name')->nullable();
            $table->binary('complete_staff_work')->nullable();
            $table->string('complete_staff_work_file_name')->nullable();
            $table->binary('accomplishment_report')->nullable();
            $table->string('accomplishment_report_file_name')->nullable();
            $table->json('supplementary_document')->nullable();
            $table->json('supplementary_document_file_name')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_documents');
    }
};
