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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable(); // Add category_id as a foreign key

            // If you want to add a foreign key constraint:
            $table->foreign('category_id')->references('id')->on('vehicle_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Drop foreign key constraint
            $table->dropColumn('category_id'); // Drop the category_id column
        });
    }
};
