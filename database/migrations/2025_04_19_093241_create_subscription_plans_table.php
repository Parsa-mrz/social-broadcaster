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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string ('description');
            $table->decimal('price',10,2);
            $table->decimal ('discount',10,2);
            $table->foreignId ('currency_id')->constrained()->onDelete('cascade');
            $table->string ('interval');
            $table->jsonb ('features');
            $table->json ('limits');
            $table->boolean ('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
