<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Commands\CreateApplicationCommand;
use App\Http\Contracts\Queries\ApplicationQuery;
use App\Http\Requests\ApplicationShowRequest;
use App\Http\Requests\CreateApplicationRequest;
use App\Http\Resources\ApplicationsResource;
use App\Http\Resources\MessagesResource;
use Illuminate\Support\Facades\Auth;

final class ApplicationController extends Controller
{
    public function __construct(public ApplicationQuery $applicationQuery)
    {
    }

    /**
     * @param ApplicationShowRequest $request
     * @return ApplicationsResource
     */
    public function index(ApplicationShowRequest $request): ApplicationsResource
    {
        return (new ApplicationsResource(
            $this->applicationQuery->getAll($request->getDTO())
        ));
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
