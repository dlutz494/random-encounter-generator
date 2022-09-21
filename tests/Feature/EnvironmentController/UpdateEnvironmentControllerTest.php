<?php

namespace Tests\Feature\EnvironmentController;

use App\Models\Environment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateEnvironmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_updates_an_environment() : void
    {
        $environment = Environment::factory()->create();
        $payload = [
            'name' => 'New Environment',
        ];

        $this->json('PUT', 'api/environment/' . $environment->getKey(), $payload)->assertSuccessful();

        $this->assertDatabaseHas('environments', $payload);
    }

    public function test_it_returns_422_with_invalid_name()
    {
        $environment = Environment::factory()->create();
        $payload = [
            'name' => 123,
        ];

        $this->json('PUT', 'api/environment/' . $environment->getKey(), $payload)
            ->assertStatus(422)
            ->assertSee('The name must be a string.');
    }

}
