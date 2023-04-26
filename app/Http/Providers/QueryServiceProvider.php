<?php

declare(strict_types=1);

namespace App\Http\Providers;

use App\Http\Contracts\Queries\CityQuery as CityQueryContract;
use App\Http\Contracts\Queries\UserQuery as UserQueryContract;
use App\Http\Queries\CityQuery;
use App\Http\Queries\UserQuery;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

final class QueryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        // Queries
        CityQueryContract::class => CityQuery::class,
        UserQueryContract::class => UserQuery::class,
    ];
}
