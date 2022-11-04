<?php

namespace Tests\Feature\EnvironmentController;

use App\Models\Environment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateEnvironmentResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Environment $environment;

    protected function setUp() : void
    {
        parent::setUp();

        $this->environment = Environment::factory()->create();
    }

    public function test_it_updates_an_environment() : void
    {
        $payload = [
            'name' => 'New Environment',
        ];

        $this->json('PUT', 'api/environment/' . $this->environment->getKey(), $payload)->assertSuccessful();

        $this->assertDatabaseHas('environments', $payload);
    }

    public function test_it_returns_422_with_invalid_name()
    {
        $payload = [
            'name' => 123,
        ];

        $this->json('PUT', 'api/environment/' . $this->environment->getKey(), $payload)
            ->assertStatus(422)
            ->assertSee('The name must be a string.');
    }

}
