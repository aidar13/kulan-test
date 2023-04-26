<?php

namespace App\Http\Controllers;

use App\Http\Commands\RegisterCommand;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\TokenResource;
use Illuminate\Contracts\Bus\Dispatcher;

class RegisterController extends Controller
{
    public function __construct(private readonly Dispatcher $dispatcher)
    {
    }

    /**
     * @param RegisterRequest $request
     * @return TokenResource
     */
    public function __invoke(RegisterRequest $request): TokenResource
    {
        $command = new RegisterCommand($request->getDTO());

        $tokenResult = $this->dispatcher->dispatch($command);

        return new TokenResource($tokenResult);
    }
}
