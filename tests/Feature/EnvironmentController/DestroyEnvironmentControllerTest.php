<?php

namespace Tests\Feature\EnvironmentController;

use App\Models\Environment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyEnvironmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_destroys_an_environment() : void
    {
        $environment = Environment::factory()->create();

        $this->json('DELETE', 'api/environment/' . $environment->getKey());

        $this->assertDatabaseMissing('environments', $environment->toArray());
    }

}
