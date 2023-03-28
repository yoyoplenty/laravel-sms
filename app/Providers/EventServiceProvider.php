<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Events\UserResetPassword;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendVerificationEmail;
use App\Listeners\SendResetPasswordEmail;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreated::class => [
            SendVerificationEmail::class,
        ],
        UserResetPassword::class => [
            SendResetPasswordEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool {
        return false;
    }
}
