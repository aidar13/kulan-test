<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Contracts\Queries\CityQuery;
use App\Http\Requests\CityShowRequest;
use App\Http\Resources\CitiesResource;

final class CityController extends Controller
{
    public function __construct(public CityQuery $cityQuery)
    {
    }

    /**
     * @param CityShowRequest $request
     * @return CitiesResource
     */
    public function index(CityShowRequest $request): CitiesResource
    {
        $cities = $this->cityQuery->getAll($request->getDTO());

        return (new CitiesResource($cities));
    }
}
