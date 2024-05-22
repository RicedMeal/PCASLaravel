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
        Schema::create('requisition', function (Blueprint $table) {
            #$table->id();
            $table->string('ris_no')->primary();
            $table->unsignedBigInteger('project_id');
            $table->string('division')->nullable();
            $table->string('office');
            $table->string('responsibility_center_code')->nullable();
            #$table->string('ris_no')->nullable(); #Requisition and Issue Slip Number
            $table->string('sai_no')->nullable();
            $table->date('date');
            $table->string('purpose');
            $table->string('requested_by_name');
            $table->string('requested_by_designation');
            $table->string('approved_by_name');
            $table->string('approved_by_designation');
            $table->string('issued_by_name');
            $table->string('issued_by_designation');
            $table->string('received_by_name');
            $table->string('received_by_designation');
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });

        /*Schema::create('requisition_items', function (Blueprint $table) {
           #$table->id();
            $table->integer('stock_no');
            $table->unsignedBigInteger('requisition_id');
            $table->string('unit');
            $table->string('description');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('requisition_id')->references('ris_no')->on('requisition')->onUpdate('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisition');
        Schema::dropIfExists('requisition_items');
    }
};
