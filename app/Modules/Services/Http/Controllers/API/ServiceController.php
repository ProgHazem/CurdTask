<?php

namespace App\Modules\Services\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListAllRequest;
use App\Modules\Customers\Models\Customer;
use App\Modules\Services\Http\Requests\ServiceRequest;
use App\Modules\Services\Http\Resources\ServiceResource;
use App\Modules\Services\Models\Service;
use App\Modules\Services\Services\ServiceService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Exception;
use OpenApi\Annotations as OA;

class ServiceController extends Controller
{
   
    public function __construct(private ServiceService $serviceService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/services",
     *     summary="List all services",
     *     tags={"Services"},
     *     security={
     *        {"bearerAuth": {}}
     *     },
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=true,
     *         @OA\Schema(type="integer", minimum=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of results per page",
     *         required=false,
     *         @OA\Schema(type="integer", minimum=1)
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ServiceResource")
     *             ),
     *             @OA\Property(
     *                 property="page",
     *                 type="object",
     *                 @OA\Property(property="page", type="integer", example=1),
     *                 @OA\Property(property="per_page", type="integer", example=15),
     *                 @OA\Property(property="last_page", type="integer", example=10),
     *                 @OA\Property(property="count", type="integer", example=150)
     *             )
     *         )
     *     )
     * )
     * @param ListAllRequest $listAllRequest
     * @return JsonResponse
     * @throws Exception
     */
    public function index(ListAllRequest $listAllRequest): JsonResponse
    {
        $result = $this->serviceService->index($listAllRequest->validated());
        $response = [
            "data" => ServiceResource::collection($result),
            "page" => [
                "page" => $result->currentPage(),
                "per_page" => $result->perPage(),
                "last_page" => $result->lastPage(),
                "count" => $result->total(),
            ]
        ];
        return $this->successResponse($response, ResponseAlias::HTTP_OK);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/services/get-services-customer/{customer}",
     *     summary="Get a service according to specific customer",
     *     tags={"Services"},
     *     security={
     *        {"bearerAuth": {}}
     *     },
     *     @OA\Parameter(
     *         name="customer",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ServiceResource")
     *             ),
     *             @OA\Property(property="message", type="string", example="null"),
     *             @OA\Property(property="status", type="string", example="success")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Invalid request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="Error"),
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Modules\\Customers\\Models\\Customer] ")
     *         )
     *     )
     * )
     * @param Service $service
     * @return JsonResponse
     * @throws Exception
     */
    public function getServicesCustomer(Customer $customer): JsonResponse
    {
        $result = $this->serviceService->getServicesCustomer($customer);
        return $this->successResponse(ServiceResource::collection($result), ResponseAlias::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/services",
     *     summary="Create a new service",
     *     tags={"Services"},
     *     security={
     *        {"bearerAuth": {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ServiceRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/ServiceResource"),
     *             @OA\Property(property="message", type="string", example="Service created Successfully"),
     *             @OA\Property(property="status", type="string", example="success"),
     *         )
     *     ),
     * )
     * @param ServiceRequest $serviceRequest
     * @return JsonResponse
     * @throws Exception
     */
    public function store(ServiceRequest $serviceRequest): JsonResponse
    {
        try {
            $result = $this->serviceService->store($serviceRequest->validated());
            return $this->successResponse(new ServiceResource($result), ResponseAlias::HTTP_CREATED, trans('ServiceLocalization::general.service.createdSuccessfully'));
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/services/{service}",
     *     summary="Update an existing service",
     *     tags={"Services"},
     *     security={
     *        {"bearerAuth": {}}
     *     },
     *     @OA\Parameter(
     *         name="service",
     *         in="path",
     *         description="Service ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ServiceRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Service updated successfully")
     *         )
     *     ),
     *     @OA\Response(
     *          response=422, 
     *          description="Invalid request",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Name must be unique"
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="array",
     *                      @OA\Items(
     *                          type="string",
     *                          example="Name must be unique"
     *                      )
     *                  )
     *              )
     *          )
     *     )
     * )
     * @param ServiceRequest $serviceRequest
     * @param Service $service
     * @return JsonResponse
     * @throws Exception
     */
    public function update(ServiceRequest $serviceRequest, Service $service): JsonResponse
    {
        try {
            $this->serviceService->update($service, $serviceRequest->validated());
            return $this->successResponse([], ResponseAlias::HTTP_OK, trans('ServiceLocalization::general.service.updatedSuccessfully'));
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/services/{service}",
     *     summary="Delete a service",
     *     tags={"Services"},
     *     security={
     *        {"bearerAuth": {}}
     *     },
     *     @OA\Parameter(
     *         name="service",
     *         in="path",
     *         description="Service ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Service deleted successfully")
     *         )
     *     )
     * )
     * @param Service $service
     * @return JsonResponse
     */
    public function delete(Service $service): JsonResponse
    {
        $this->serviceService->delete($service);
        return $this->successResponse([], ResponseAlias::HTTP_OK, trans('ServiceLocalization::general.service.deletedSuccessfully'));
    }

}
