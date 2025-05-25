<?php

namespace App\Services\Cache\Contracts;

interface CacheServiceInterface
{
    public function get(string $key): mixed;

    public function put(string $key, mixed $value, int $ttl = 3600): void;

    public function has(string $key): bool;

    public function forget(string $key): bool;

    public function remember(string $key, int $ttl, callable $callback): mixed;

    public function generateCacheKey(string $prefix, array $params = []): string;
}
