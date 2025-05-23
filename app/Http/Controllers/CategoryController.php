<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Services\Category\Contracts\CategoryServiceInterface;
use App\Utils\Contracts\LoggerInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryServiceInterface $categoryService,
        private LoggerInterface $logger,
    ){
        //
    }

    public function index(): JsonResponse|AnonymousResourceCollection
    {
        try {
            $categories = $this->categoryService->findAll();
        } catch (Exception $e) {
            $this->logger ->error('Error while getting categories: ', ['message' => $e]);

            return response()->json(['message', 'Unexpected error, please try again later.'], 500);
        }

        return CategoryResource::collection($categories);
    }
}
