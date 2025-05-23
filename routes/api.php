<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceProviderController;
use Illuminate\Support\Facades\Route;

Route::get('/providers', [ServiceProviderController::class, 'index']);
Route::get('/providers/{service_provider}', [ServiceProviderController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
