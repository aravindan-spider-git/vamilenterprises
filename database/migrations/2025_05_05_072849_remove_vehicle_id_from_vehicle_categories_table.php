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
        Schema::table('vehicle_categories', function (Blueprint $table) {
            $table->dropForeign(['vehicle_id']); // Drop foreign key
            $table->dropColumn('vehicle_id');     // Drop the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_categories', function (Blueprint $table) {
            $table->foreignId('vehicle_id')
            ->constrained('vehicles')
            ->onDelete('cascade');
        });
    }
};
