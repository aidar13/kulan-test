<?php

namespace App\Http\Providers;

use App\Http\Commands\AttachRoleCommand;
use App\Http\Commands\CreateApplicationCommand;
use App\Http\Commands\MergeApplicationsCommand;
use App\Http\Commands\RegisterCommand;
use App\Http\Commands\RejectApplicationCommand;
use App\Http\Handlers\AttachRoleHandler;
use App\Http\Handlers\CreateApplicationHandler;
use App\Http\Handlers\MergeApplicationsHandler;
use App\Http\Handlers\RegisterHandler;
use App\Http\Handlers\RejectApplicationHandler;
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
            RejectApplicationCommand::class => RejectApplicationHandler::class,
            MergeApplicationsCommand::class => MergeApplicationsHandler::class,
            AttachRoleCommand::class        => AttachRoleHandler::class,
        ]);
    }
}
