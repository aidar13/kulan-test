<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next): mixed
    {
        if (!Auth::user()) {
            return response()->json([
                'errors' => [
                    'Unauthorized user'
                ]
            ], 401);
        }
        return $next($request);
    }
}
