<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceProvider\IndexServiceProviderRequest;
use App\Http\Requests\ServiceProvider\ShowServiceProviderRequest;
use App\Http\Resources\ServiceProviderResource;
use App\Services\ServiceProvider\Contracts\ServiceProviderServiceInterface;
use App\Utils\Contracts\LoggerInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource as ResourceJsonResponse;
use Throwable;

class ServiceProviderController extends Controller
{
    public function __construct(
        private ServiceProviderServiceInterface $serviceProviderService,
        private LoggerInterface $logger,
    ){
        //
    }

    public function index(IndexServiceProviderRequest $request): AnonymousResourceCollection|JsonResponse
    {
        $pagination = 12;
        $filters = [];

        if ($request->has('category_id') && !empty($request->get('category_id'))) {
            $filters['category_id'] = $request->get('category_id');
        }

        try {
            $providers = $this->serviceProviderService->findAllWithPagination($pagination, $filters);
        } catch (Exception $e) {
            $this->logger ->error('Error while getting providers: ', ['message' => $e]);

            return response()->json(['message', 'Unexpected error, please try again later.'], 500);
        }

        return ServiceProviderResource::collection($providers);
    }

    /**
     * @throws Throwable
     */
    public function show(ShowServiceProviderRequest $request): JsonResponse|ResourceJsonResponse
    {
        $id = $request->input('service_provider');

        try {
            $serviceProvider = $this->serviceProviderService->find($id, ['category']);
        } catch (Exception $e) {
            $this->logger ->error('Error while getting single call charge: ', ['message' => $e]);

            return response()->json(['message', 'Unexpected error, please try again later.'], 500);
        }

        return $serviceProvider->toResource();
    }
}
