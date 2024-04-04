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
            $table->string('department')->index();
            $table->string('project_description')->index();
            $table->string('person_in_charge')->index();
            $table->date('project_date')->index();
            $table->string('project_type')->nullable()->index(); 
            $table->double('project_cost')->nullable()->index();
            $table->string('project_status')->index();

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
