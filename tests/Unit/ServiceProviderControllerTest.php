<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceProviderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_all_service_providers()
    {
        ServiceProvider::factory()->count(24)->create();

        $response = $this->getJson('/api/providers');

        $response->assertStatus(200)
            ->assertJsonFragment(['current_page' => 1])
            ->assertJsonCount(12, 'data');
    }

    /** @test */
    public function it_returns_single_provider_by_id()
    {
        $provider = ServiceProvider::factory()->create();

        $response = $this->getJson("/api/providers/{$provider->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $provider->id,
                'name' => $provider->name,
            ]);
    }

    /** @test */
    public function it_returns_404_for_missing_provider()
    {
        $response = $this->getJson('/api/providers/999');

        $response->assertStatus(404);
    }
}
