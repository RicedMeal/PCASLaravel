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
        Schema::create('pfmo_supplies', function (Blueprint $table) {
            $table->id();
            //$table->string('stock_no')->primary();
            $table->date('entry_date');
            $table->string('user');
            $table->string('custom_code')->default();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pfmo_supplies');
    }
};
