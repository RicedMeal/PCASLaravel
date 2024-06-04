<?php

use App\Models\MarketStudies;
use App\Models\MarketStudiesItems;
use App\Models\MarketStudiesSupplier;
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
            $table->float('subtotal_average')->nullable();
            $table->float('average_unit_price')->nullable();
            $table->float('total_average')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade');
        });

        Schema::create('market_studies_items', function (Blueprint $table) {
            $table->id();
            $table->integer('item_no');
            $table->string('particulars');
            $table->string('unit');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('market_studies_market_studies_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MarketStudies::class);
            $table->foreignIdFor(MarketStudiesItems::class);
        });

        Schema::create('ms_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MarketStudiesSupplier::class);
            $table->foreignIdFor(MarketStudiesItems::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_studies');
        Schema::dropIfExists('market_studies_items');
        Schema::dropIfExists('market_studies_market_studies_items');
    }
};