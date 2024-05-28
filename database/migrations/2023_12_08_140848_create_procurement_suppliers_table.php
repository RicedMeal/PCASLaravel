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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('category', 255);
            $table->string('address', 255)->nullable();
            $table->string('contact_number', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('representative_name', 255)->nullable();
            $table->string('representative_contact_number', 255)->nullable();
            $table->string('representative_email', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
