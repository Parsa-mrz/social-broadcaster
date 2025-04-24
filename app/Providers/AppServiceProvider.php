<?php

namespace App\Providers;

use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Models\Post;
use App\Models\PostPlatform;
use App\Models\SocialAccount;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Observers\SubscriptionObserver;
use App\Observers\UserObserver;
use App\Policies\PaymentGatewayPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\PostPlatformPolicy;
use App\Policies\PostPolicy;
use App\Policies\SocialAccountPolicy;
use App\Policies\SubscriptionPlanPolicy;
use App\Policies\SubscriptionPolicy;
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
        Subscription::observe(SubscriptionObserver::class);
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy (User::class, UserPolicy::class);
        Gate::policy (SubscriptionPlan::class, SubscriptionPlanPolicy::class);
        Gate::policy (SocialAccount::class, SocialAccountPolicy::class);
        Gate::policy (Payment::class, PaymentPolicy::class);
        Gate::policy (PaymentGateway::class, PaymentGatewayPolicy::class);
        Gate::policy (Subscription::class, SubscriptionPolicy::class);
        Gate::policy (SocialAccount::class, SocialAccountPolicy::class);
        Gate::policy (PostPlatform::class, PostPlatformPolicy::class);

    }
}
