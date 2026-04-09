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
        Schema::table('services', function (Blueprint $table) {
            //
            $table->foreignId('hub_id')->nullable()->constrained('hubs')->cascadeOnDelete();
            $table->boolean('is_global')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeignIdFor('hubs');
            $table->dropColumn(['hub_id', 'is_global']);
            //
        });
    }
};
