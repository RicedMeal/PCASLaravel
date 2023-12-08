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
        Schema::create('supplementary_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->string('project_title');
            $table->date('project_date');
            $table->id();
            $table->string('file_name')->nullable(); // valdiation for input name 
            $table->binary('file_content')->nullable(); 
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('project_title')->references('project_title')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('project_date')->references('project_date')->on('projects')->onUpdate('cascade')->onDelete('cascade');
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
