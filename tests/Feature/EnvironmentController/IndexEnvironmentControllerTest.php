<?php

namespace Tests\Feature\EnvironmentController;

use App\Models\Environment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexEnvironmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_an_environment() : void
    {
        $environment = Environment::factory()->create();

        $response = $this->json('GET', 'api/environment');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name' => $environment->name,
            ],
        ]);
    }

    public function test_it_returns_multiple_environments() : void
    {
        $environment = Environment::factory(3)->create();

        $response = $this->json('GET', 'api/environment');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name' => $environment[0]->name,
            ],
            [
                'name' => $environment[1]->name,
            ],
            [
                'name' => $environment[2]->name,
            ],
        ]);
    }

    public function test_it_returns_no_environments() : void
    {
        $response = $this->json('GET', 'api/environment');

        $response->assertSuccessful();
        $response->assertJson([]);
    }
}
