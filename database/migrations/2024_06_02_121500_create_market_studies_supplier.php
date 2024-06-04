<?php

use App\Models\MarketStudies;
use App\Models\MarketStudiesItems;
use App\Models\MarketStudiesSupplier;
use App\Models\MarketStudiesSuppliersItems;
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
        Schema::create('market_studies_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('supplier_address');
            $table->string('supplier_contact');
            $table->float('subtotal');
            $table->unsignedBigInteger('market_studies_items_id')->nullable();
            $table->unsignedBigInteger('market_studies_id')->nullable();
            $table->timestamps();
        });

        Schema::create('supplier_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('market_studies_supplier_id')->nullable();
            $table->float('unit_price');
            $table->float('amount');
            $table->unsignedBigInteger('market_studies_items_id')->nullable();
            $table->unsignedBigInteger('market_studies_id')->nullable();
            $table->timestamps();
        });

        Schema::create('market_studies_market_studies_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MarketStudiesSupplier::class);
            $table->foreignIdFor(MarketStudies::class);
            // $table->foreignIdFor(MarketStudiesItems::class);
            //$table->foreignIdFor(MarketStudiesSuppliersItems::class);
        });
        
        Schema::create('ms_supplier_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MarketStudiesSupplier::class);
            // $table->foreignIdFor(MarketStudies::class);
            //$table->foreignIdFor(MarketStudiesItems::class);
            $table->foreignIdFor(MarketStudiesSuppliersItems::class);
        });

        Schema::create('ms_supplier', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(MarketStudiesSupplier::class);
            $table->foreignIdFor(MarketStudies::class);
            // //$table->foreignIdFor(MarketStudiesItems::class);
            $table->foreignIdFor(MarketStudiesSuppliersItems::class);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_studies_supplier');
        Schema::dropIfExists('market_studies_market_studies_supplier');
        Schema::dropIfExists('supplier_items');
        Schema::dropIfExists('ms_supplier_items');
        Schema::dropIfExists('ms_supplier');
    }
};
