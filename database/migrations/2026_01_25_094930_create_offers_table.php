<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hub_id')
                ->constrained('hubs')
                ->cascadeOnDelete();

            $table->json('title');
            $table->string('type', 20)->default('daily');

            $table->bigInteger('price');

            $table->integer('duration');

            $table->json('description')->nullable();

            // التاريخ والساعة للبداية والنهاية
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');

            $table->timestamps();

            // indexes للـ performance
            $table->index('starts_at');
            $table->index('ends_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
