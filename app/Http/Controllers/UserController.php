<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Commands\AttachRoleCommand;
use App\Http\Contracts\Queries\UserQuery;
use App\Http\Requests\AttachRoleRequest;
use App\Http\Resources\UsersResource;
use App\Http\Resources\MessagesResource;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    public function __construct(public UserQuery $userQuery)
    {
    }

    /**
     * @param Request $request
     * @return UsersResource
     */
    public function index(Request $request): UsersResource
    {
        return new UsersResource($this->userQuery->getAll(
            (int)$request->get('limit'),
            (int)$request->get('page')
        ));
    }

    /**
     * @param int $userId
     * @param AttachRoleRequest $request
     * @return MessagesResource
     */
    public function attachRole(int $userId, AttachRoleRequest $request): MessagesResource
    {
        dispatch(new AttachRoleCommand(
            $userId,
            (int)$request->get('roleId')
        ));

        return (new MessagesResource(null))
            ->setMessage('Роль успешно назначен!');
    }
}
