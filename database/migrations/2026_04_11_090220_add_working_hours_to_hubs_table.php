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
        Schema::table('hubs', function (Blueprint $table) {
            //
            $table->time('working_hours_start')->after('location_id');
            $table->time('working_hours_end')->after('working_hours_start');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hubs', function (Blueprint $table) {
            //
            $table->dropColumn('working_hours_start');
            $table->dropColumn('working_hours_end');
        });
    }
};
