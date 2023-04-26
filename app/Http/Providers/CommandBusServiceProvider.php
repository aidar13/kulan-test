<?php

namespace App\Http\Providers;

use App\Http\Commands\CreateApplicationCommand;
use App\Http\Commands\RegisterCommand;
use App\Http\Handlers\CreateApplicationHandler;
use App\Http\Handlers\RegisterHandler;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

class CommandBusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerCommandHandlers();
    }

    private function registerCommandHandlers(): void
    {
        Bus::map([
            RegisterCommand::class          => RegisterHandler::class,
            CreateApplicationCommand::class => CreateApplicationHandler::class,
        ]);
    }
}
