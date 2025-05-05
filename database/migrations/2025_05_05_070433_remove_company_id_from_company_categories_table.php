<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_categories', function (Blueprint $table) {
            $table->dropForeign(['company_id']); // Drop foreign key
            $table->dropColumn('company_id');     // Drop the column
        });
    }

    public function down(): void
    {
        Schema::table('company_categories', function (Blueprint $table) {
            $table->foreignId('company_id')
                  ->constrained('companies')
                  ->onDelete('cascade');
        });
    }
};
