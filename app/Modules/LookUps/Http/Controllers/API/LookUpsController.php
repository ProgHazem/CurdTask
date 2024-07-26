<?php

namespace App\Modules\LookUps\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Modules\Customers\Http\Resources\CustomerLookupResource;
use App\Modules\LookUps\Repositories\LookUpsRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use OpenApi\Annotations as OA;

class LookUpsController extends Controller
{
    public function __construct(private LookUpsRepository $lookUpsRepository)
    {}

    /**
     * @OA\Get(
     *     path="/api/v1/look-ups/customers",
     *     summary="List all customers",
     *     tags={"Lookups"},
     *     security={
     *         {"bearerAuth": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CustomerLockupResource")
     *             )
     *         )
     *     )
     * )
     */
    public function getCustomers()
    {
        $result = $this->lookUpsRepository->getCustomers();
        return $this->successResponse(CustomerLookupResource::collection($result), ResponseAlias::HTTP_OK);
    }
}
