<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\City;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ApplicationTest extends TestCase
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

    public function testGetAllApplications()
    {
        $applications = Application::factory()->count(5)->create();

        $response = $this->get(route('applications.index'));
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'takeDate',
                        'senderAddress',
                        'receiverAddress',
                        'createdAt',
                        'senderCity' => [
                            'id', 'name'
                        ],
                        'receiverCity' => [
                            'id', 'name'
                        ],
                        'user' => [
                            'id', 'name', 'email'
                        ],
                        'status' => [
                            'id', 'title'
                        ]
                    ]
                ],
            ])->assertJsonPath('data.*.id', array_reverse($applications->modelKeys()));
    }

    public function testRejectApplication()
    {
        $application = Application::factory()->create();

        $response = $this->post(route('applications.reject', $application->id));
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Заявка отклонена!'
            ]);

        $this->assertDatabaseHas('applications', [
            'id'        => $application->id,
            'status_id' => Application::STATUS_ID_REJECTED
        ]);
    }

    public function testCreateApplication()
    {
        Carbon::setTestNow(now());

        /** @var Application $application */
        $application = Application::factory()->make();

        $response = $this->post(route('applications.store'), [
            'takeDate' => $application->take_date,
            'whereCityId' => $application->from_city_id,
            'toCityId' => $application->to_city_id,
            'senderAddress' => $application->sender_address,
            'receiverAddress' => $application->receiver_address,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Заявка успешно создана!'
            ]);

        $this->assertDatabaseHas('applications', [
            'status_id'        => Application::STATUS_ID_CREATED,
            'take_date'        => $application->take_date,
            'from_city_id'     => $application->from_city_id,
            'to_city_id'       => $application->to_city_id,
            'sender_address'   => $application->sender_address,
            'receiver_address' => $application->receiver_address,
            'created_at'       => Carbon::now(),
            'user_id'          => Auth::id()
        ]);
    }

    public function testMergeApplications()
    {
        $applications = Application::factory()->count(3)->create([
            'take_date' => $this->faker->date,
            'from_city_id'     => City::factory()->create(),
            'to_city_id'       => City::factory()->create(),
        ]);

        $response = $this->post(route('applications.merge-applications'), [
            'applicationIds' => $applications->modelKeys()
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Успешный ответ'
            ]);

        /** @var Order $order */
        $order = Order::first();

        /** @var Application $application */
        foreach ($applications as $application) {
            $this->assertDatabaseHas('applications', [
                'id'        => $application->id,
                'status_id' => Application::STATUS_ID_ACCEPTED,
                'order_id'  => $order->id
            ]);
        }
    }
}
