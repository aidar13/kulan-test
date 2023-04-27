<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->signInPassport();
        $this->actingAs($user);
        $this->withoutExceptionHandling();
    }

    public function testAssignRole()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Role $role */
        $role = Role::create(['name' => $this->faker->word]);

        $response = $this->post(route('users.attach-role', ['userId' => $user->id]), [
            'roleId' => $role->id,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Роль успешно назначен!'
            ]);

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => $role->id,
            'model_id' => $user->id,
            'model_type' => $user->getMorphClass()
        ]);
    }
}
