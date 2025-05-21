<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceProviderController extends Controller
{
    public function index(Request $request): LengthAwarePaginator
    {
        $query = ServiceProvider::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        return $query->paginate(12);
    }

    public function show(ServiceProvider $serviceProvider): ServiceProvider
    {
        return $serviceProvider->load('category');
    }
}
