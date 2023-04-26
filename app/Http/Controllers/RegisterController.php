<?php

namespace App\Http\Controllers;

use App\Http\Commands\RegisterCommand;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\MessagesResource;
use Illuminate\Contracts\Bus\Dispatcher;

class RegisterController extends Controller
{
    public function __construct(private readonly Dispatcher $dispatcher)
    {
    }

    /**
     * @param RegisterRequest $request
     * @return MessagesResource
     */
    public function __invoke(RegisterRequest $request): MessagesResource
    {
        $command = new RegisterCommand($request->getDTO());

        $this->dispatcher->dispatch($command);

        return (new MessagesResource(null))
            ->setMessage('Успешная регистрация!');
    }
}
