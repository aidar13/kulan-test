<?php

declare(strict_types=1);

namespace App\Http\Providers;

use Illuminate\Support\ServiceProvider;

class RegisterServiceProvider extends ServiceProvider
{
  /**
       * Register any application services.
       *
       * @return void
       */
    public function register(): void
    {
        $this->app->register(CommandBusServiceProvider::class);
        $this->app->register(QueryServiceProvider::class);
    }
}
