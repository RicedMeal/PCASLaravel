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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_title')->index();
            $table->string('department_office')->index();
            $table->string('project_description')->index();
            $table->string('person_in_charge')->index();
            $table->date('project_date')->index();
            $table->binary('purchase_request')->nullable();
            $table->binary('price_quotation')->nullable();
            $table->binary('abstract_of_canvass')->nullable();
            $table->binary('material_and_cost_estimates')->nullable();
            $table->binary('budget_utilization_request')->nullable();
            $table->binary('project_initiation_proposal')->nullable();
            $table->binary('annual_procurement_plan')->nullable();
            $table->binary('purchase_request_with_number')->nullable();
            $table->binary('market_study')->nullable();
            $table->binary('certificate_of_fund_allotment')->nullable();
            $table->binary('csw')->nullable();
            $table->binary('accomplishment_report')->nullable();
            $table->binary('project_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
