<?php

namespace Tests\Feature\EnvironmentResourceController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreEnvironmentResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_an_environment() : void
    {
        $name = 'Store Test';

        $response = $this->json('POST', 'api/environment', [
            'name' => $name,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('environments', [
            'name' => $name,
        ]);
    }


    public function test_it_does_not_store_an_environment_without_a_name() : void
    {
        $response = $this->json('POST', 'api/environment', [
            'name' => null,
        ]);

        $response->assertUnprocessable();
    }

}
