<?php

namespace Tests\Feature\EnvironmentResourceController;

use App\Models\Environment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowEnvironmentResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_an_environment() : void
    {
        $name = 'Show Environment';
        $environment = Environment::factory()->create([
            'name' => $name,
        ]);

        $response = $this->json('GET', 'api/environment/' . $environment->getKey());

        $response->assertSuccessful();
        $response->assertJson(
            [
                'data' => [
                    'name' => $name,
                ],
            ]
        );
    }
}
