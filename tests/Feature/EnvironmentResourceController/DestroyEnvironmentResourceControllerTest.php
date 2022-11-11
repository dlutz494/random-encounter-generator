<?php

namespace Tests\Feature\EnvironmentResourceController;

use App\Models\Environment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyEnvironmentResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_destroys_an_environment() : void
    {
        $environment = Environment::factory()->create();

        $this->assertDatabaseHas('environments', $environment->toArray());

        $this->json('DELETE', 'api/environment/' . $environment->getKey());

        $this->assertDatabaseMissing('environments', $environment->toArray());
    }

    public function test_it_returns_405_without_an_id() : void
    {
        $this->json('DELETE', 'api/environment/')->assertStatus(405);
    }

}
