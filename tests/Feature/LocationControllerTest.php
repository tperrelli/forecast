<?php

namespace Tests\Feature;

use App\Models\Location;
use Tests\TestCase;
use App\Models\Stocks;
use App\Models\User;
use App\Repositories\LocationApiRepository;
use App\Repositories\LocationEloquentRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;

    private $url = 'api/locations';

    private $user;
    private $locations;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->locations = Location::factory()
            ->count(2)
            ->create(['user_id' => $this->user->id]);
    }

    public function test_index_dashboard(): void
    {
        $this->mock(locationEloquentRepository::class, function ($mock) {
            $mock->shouldReceive('getAll')
                ->once()
                ->andReturn($this->locations);
        });

        $response = $this->actingAs($this->user)->get($this->url . '/');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson($response->json());
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'city',
                    'country',
                    'lat',
                    'lng',
                    'weather',
                    'weather_description',
                    'temp_min',
                    'temp_max',
                    'user_id',
                ]
            ]
        ]);   
    }

    public function test_searc_and_assert_a_new_record_was_created(): void
    {
        $mockData = [
            'weather' => [
                [
                    'main' => 'sunny',
                    'description' => 'description',
                    'icon' => '2d0'
                ]
            ],
            'coord' => [
                'lat' => -10.000,
                'lon' => -32.000,
            ],
            'main' => [
                'temp_max' => 30,
                'temp_min' => -10
            ],
            'name' => 'london',
            'country' => 'uk',
            'user_id' => $this->user->id
        ];

        Http::fake([
            '*' => Http::response($mockData)
        ]);

        $response = $this->actingAs($this->user)->post($this->url . '/search', [
            'country' => 'uk',
            'city' => 'london'
        ]);

        $response->assertStatus(200);
        
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'city',
                    'country',
                    'lat',
                    'lng',
                    'weather',
                    'weather_description',
                    'temp_min',
                    'temp_max',
                    'user_id',
                ]
            ]
        ]);
        
        $this->assertCount(3, $response->getData(true)['data']);
    }
}