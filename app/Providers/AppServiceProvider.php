<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Observers\UserObserver;
use App\Policies\PaymentPolicy;
use App\Policies\PostPolicy;
use App\Policies\SocialAccountPolicy;
use App\Policies\SubscriptionPlanPolicy;
use App\Policies\UserPolicy;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\SocialAccountRepository;
use App\Repositories\UserRepository;
use App\Services\SocialAccountService;
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

        $this->app->singleton(SocialAccountService::class, function ($app) {
            return new SocialAccountService($app->make(SocialAccountRepository::class));
        });

        $this->app->singleton(SocialAccountRepository::class, function ($app) {
            return new SocialAccountRepository();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy (User::class, UserPolicy::class);
        Gate::policy (SubscriptionPlanPolicy::class, SubscriptionPlanPolicy::class);
        Gate::policy (SocialAccountPolicy::class, SocialAccountPolicy::class);
        Gate::policy (PaymentPolicy::class, PaymentPolicy::class);
    }
}
