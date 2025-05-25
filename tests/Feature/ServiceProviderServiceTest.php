<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\ServiceProvider;
use App\Repositories\Contracts\ServiceProviderRepositoryInterface;
use App\Services\ServiceProvider\ServiceProviderService;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Tests\TestCase;

class ServiceProviderServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh');
    }

    public function test_it_returns_paginated_result_and_stores_in_cache(): void
    {
        $number = 10;
        $page = 1;
        $filters = ['category_id' => 1];
        $params = ['number' => $number, 'page' => $page, 'filters' => $filters];
        $cacheKey = 'service_provider_paginated:' . md5(json_encode($params));

        $fakePagination = new LengthAwarePaginator(
            collect([new ServiceProvider(['name' => 'Test Provider'])]),
            1,
            $number,
            $page
        );

        $repository = Mockery::mock(ServiceProviderRepositoryInterface::class);
        $repository->shouldReceive('findAllWithPagination')
            ->once()
            ->with($number, $filters)
            ->andReturn($fakePagination);

        $cacheService = Mockery::mock(\App\Services\Cache\CacheService::class);
        $cacheService->shouldReceive('generateCacheKey')
            ->once()
            ->with('service_provider_paginated', $params)
            ->andReturn($cacheKey);

        $cacheService->shouldReceive('remember')
            ->once()
            ->with($cacheKey, 3600, \Closure::class)
            ->andReturnUsing(function ($key, $ttl, $callback) {
                return $callback();
            });

        $service = new ServiceProviderService($repository, $cacheService);

        $result = $service->findAllWithPagination($number, $page, $filters);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertEquals('Test Provider', $result->items()[0]->name);
    }

    public function test_cache_is_used_on_second_call(): void
    {
        $page = 1; // Add page explicitly
        // Create a category for foreign key
        $category = Category::factory()->create();

        // Create a service provider with valid category_id
        ServiceProvider::factory()->create([
            'category_id' => $category->id,
        ]);

        $service = app(ServiceProviderService::class);

        // Use valid filter by category_id
        $filters = ['category_id' => $category->id];
        $number = 5;

        $firstCall = $service->findAllWithPagination($number, $page, $filters);
        $secondCall = $service->findAllWithPagination($number, $page, $filters);

        $this->assertNotEmpty($firstCall->items());
        $this->assertNotEmpty($secondCall->items());
        $this->assertEquals($firstCall->items()[0]->id, $secondCall->items()[0]->id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}
