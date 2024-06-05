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
            $table->string('end_user');
            $table->float('abc')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade');
        });

        Schema::create('market_studies_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_studies_id');
            $table->integer('item_no');
            $table->string('particulars');
            $table->string('unit');
            $table->integer('quantity');
            $table->float('average_unit_price')->nullable();
            $table->float('average_amount')->nullable();
            $table->float('average_subtotal')->nullable();
            $table->timestamps();
            $table->foreign('market_studies_id')->references('id')->on('market_studies')->onUpdate('cascade');
        });

        // Schema::create('market_studies_market_studies_items', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignIdFor(\App\Models\MarketStudies::class);
        //     $table->foreignIdFor(\App\Models\MarketStudiesItems::class);
        // });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_studies');
        Schema::dropIfExists('market_studies_items');
        //Schema::dropIfExists('market_studies_market_studies_items');
    }
};
