<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use App\Policies\SocialAccountPolicy;
use App\Policies\SubscriptionPlanPolicy;
use App\Policies\UserPolicy;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy (User::class, UserPolicy::class);
        Gate::policy (SubscriptionPlanPolicy::class, SubscriptionPlanPolicy::class);
        Gate::policy (SocialAccountPolicy::class, SocialAccountPolicy::class);
    }
}
