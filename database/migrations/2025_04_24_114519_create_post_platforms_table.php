<?php

use App\Enums\PostPlatformStatusEnum;
use App\Models\PostPlatform;
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
        Schema::create('post_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('post_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId ('social_account_id')->constrained('social_accounts')->onDelete('cascade');
            $table->dateTime ('scheduled_at')->nullable();
            $table->dateTime ('published_at')->nullable();
            $table->string ('status')->default (PostPlatformStatusEnum::SCHEDULED->value);
            $table->jsonb ('responses')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_platforms');
    }
};
