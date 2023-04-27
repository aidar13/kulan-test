<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function testGetAllCities()
    {
        $user = User::factory()->create();

        /** @var Country $country */
        $country = Country::factory()->create();

        $cities = City::factory()->count(5)->create(['country_id' => $country->id]);

        $response = $this->actingAs($user)->get(route('cities.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'name',
                        'id',
                        'country' => [
                            'id', 'name'
                        ]
                    ]
                ],
            ])->assertJsonPath('data.*.id', array_reverse($cities->modelKeys()));
    }
}
