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
        Schema::create('market_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('market_study_title')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('market_study_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_study_id');
            $table->string('market_study_url')->nullable();
            $table->string('market_study_url_description')->nullable();
            $table->timestamps();
            $table->foreign('market_study_id')->references('id')->on('market_studies')->onUpdate('cascade')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_studies');
        Schema::dropIfExists('market_study_lists');
    }
};
