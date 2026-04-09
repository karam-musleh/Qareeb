<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Hub;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('hub_id')->nullable()->constrained('hubs')->cascadeOnDelete();
            $table->boolean('is_global')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['hub_id']);  // ✅ احذف الـ foreign key أولاً
            $table->dropColumn(['hub_id', 'is_global']);  // ✅ بعدين الـ columns
        });
    }
};
