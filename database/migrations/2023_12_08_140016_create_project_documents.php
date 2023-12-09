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
            $table->string('purchase_request')->nullable();
            $table->string('price_quotation')->nullable();
            $table->string('abstract_of_canvass')->nullable();
            $table->string('material_and_cost_estimates')->nullable();
            $table->string('budget_utilization_request')->nullable();
            $table->string('project_initiation_proposal')->nullable();
            $table->string('annual_procurement_plan')->nullable();
            $table->string('purchase_order')->nullable();
            $table->string('market_study')->nullable();
            $table->string('certificate_of_fund_allotment')->nullable();
            $table->string('complete_staff_work')->nullable();
            $table->string('accomplishment_report')->nullable();
            $table->string('supplementary_docuement')->nullable();
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
