<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceProviderResource;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Throwable;

class ServiceProviderController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = ServiceProvider::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return ServiceProviderResource::collection($query->paginate(12));
    }

    /**
     * @throws Throwable
     */
    public function show(ServiceProvider $serviceProvider): JsonResource
    {
        return $serviceProvider->load('category')->toResource();
    }
}
