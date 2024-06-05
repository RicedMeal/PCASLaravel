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
        Schema::table('pca_users', function (Blueprint $table) {
            //roles
            $table->string('role')->default('ADMIN'); //Values are Admin, User **will try to add super admin later**
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pca_users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
