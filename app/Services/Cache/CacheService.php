<?php

namespace App\Services\Cache;

use App\Services\Cache\Contracts\CacheServiceInterface;
use Illuminate\Support\Facades\Cache;
use JsonException;

class CacheService implements CacheServiceInterface
{
    public function get(string $key): mixed
    {
        return Cache::get($key);
    }

    public function put(string $key, mixed $value, int $ttl = 3600): void
    {
        Cache::put($key, $value, $ttl);
    }

    public function has(string $key): bool
    {
        return Cache::has($key);
    }

    public function forget(string $key): bool
    {
        return Cache::forget($key);
    }

    public function remember(string $key, int $ttl, callable $callback): mixed
    {
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * @throws JsonException
     */
    public function generateCacheKey(string $prefix, array $params = []): string
    {
        return $prefix . ':' . md5(json_encode($params, JSON_THROW_ON_ERROR));
    }
}
