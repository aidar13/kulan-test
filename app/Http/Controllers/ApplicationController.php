<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Commands\CreateApplicationCommand;
use App\Http\Contracts\Queries\CityQuery;
use App\Http\Requests\CreateApplicationRequest;
use App\Http\Resources\MessagesResource;
use Illuminate\Support\Facades\Auth;

final class ApplicationController extends Controller
{
    public function __construct(public CityQuery $cityQuery)
    {
    }

    /**
     * @param CreateApplicationRequest $request
     * @return MessagesResource
     */
    public function store(CreateApplicationRequest $request): MessagesResource
    {
        dispatch(new CreateApplicationCommand(Auth::id(), $request->getDTO()));

        return (new MessagesResource(null))
            ->setMessage('Заявка успешно создана!');
    }
}
