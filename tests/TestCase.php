<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signInPassport($user = null)
    {
        $user = $user ?: User::factory()->create();

        Passport::actingAs($user);

        return $user;
    }
}
