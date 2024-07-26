<?php

namespace App\Modules\Customers\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListAllRequest;
use App\Modules\Customers\Http\Requests\CustomerRequest;
use App\Modules\Customers\Http\Resources\CustomerResource;
use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Exception;
use OpenApi\Annotations as OA;

class CustomerController extends Controller
{
   
    public function __construct(private CustomerService $customerService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/customers",
     *     summary="List all customers",
     *     tags={"Customers"},
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
     *                 @OA\Items(ref="#/components/schemas/CustomerResource")
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
        $result = $this->customerService->index($listAllRequest->validated());
        $response = [
            "data" => CustomerResource::collection($result),
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
     *     path="/api/v1/customers/{customer}",
     *     summary="Get a customer by ID",
     *     tags={"Customers"},
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
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/CustomerResource"),
     *             @OA\Property(property="message", type="string", example="null"),
     *             @OA\Property(property="status", type="string", example="success"),
     *         )
     *     ),
     *     @OA\Response(
     *          response=400, 
     *          description="Invalid request",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="Error"),
     *              @OA\Property(property="message", type="string", example="Not Found"),
     *          )
     *     )
     * )
     * @param Customer $customer
     * @return JsonResponse
     * @throws Exception
     */
    public function show(Customer $customer): JsonResponse
    {
        $result = $this->customerService->show($customer);
        return $this->successResponse(new CustomerResource($result), ResponseAlias::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/customers",
     *     summary="Create a new customer",
     *     tags={"Customers"},
     *     security={
     *        {"bearerAuth": {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CustomerRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/CustomerResource"),
     *             @OA\Property(property="message", type="string", example="Customer created Successfully"),
     *             @OA\Property(property="status", type="string", example="success"),
     *         )
     *     ),
     * )
     * @param CustomerRequest $customerRequest
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CustomerRequest $customerRequest): JsonResponse
    {
        try {
            $result = $this->customerService->store($customerRequest->validated());
            return $this->successResponse(new CustomerResource($result), ResponseAlias::HTTP_CREATED, trans('CustomerLocalization::general.customer.createdSuccessfully'));
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/customers/{customer}",
     *     summary="Update an existing customer",
     *     tags={"Customers"},
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
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CustomerRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Customer updated successfully")
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
     *                  example="Email must be valid email"
     *              ),
     *              @OA\Property(
     *                  property="errors",
     *                  type="object",
     *                  @OA\Property(
     *                      property="email",
     *                      type="array",
     *                      @OA\Items(
     *                          type="string",
     *                          example="Email must be valid email"
     *                      )
     *                  )
     *              )
     *          )
     *     )
     * )
     * @param CustomerRequest $customerRequest
     * @param Customer $customer
     * @return JsonResponse
     * @throws Exception
     */
    public function update(CustomerRequest $customerRequest, Customer $customer): JsonResponse
    {
        try {
            $this->customerService->update($customer, $customerRequest->validated());
            return $this->successResponse([], ResponseAlias::HTTP_OK, trans('CustomerLocalization::general.customer.updatedSuccessfully'));
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/customers/{customer}",
     *     summary="Delete a customer",
     *     tags={"Customers"},
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
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Customer deleted successfully")
     *         )
     *     )
     * )
     * @param Customer $customer
     * @return JsonResponse
     */
    public function delete(Customer $customer): JsonResponse
    {
        $this->customerService->delete($customer);
        return $this->successResponse([], ResponseAlias::HTTP_OK, trans('CustomerLocalization::general.customer.deletedSuccessfully'));
    }

}
