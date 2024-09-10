<?php

namespace App\Providers;

use App\Modules\Appointment\Domain\Repositories\AppointmentRepository;
use App\Modules\Appointment\Infra\Repositories\EloquentAppointmentRepository;
use App\Modules\User\Domain\Repositories\UserRepository;
use App\Modules\User\Infra\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AppointmentRepository::class, EloquentAppointmentRepository::class);
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
