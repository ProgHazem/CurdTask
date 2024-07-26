<?php

namespace App\Modules\Auth\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\LoginAuthRequest;
use App\Modules\Auth\Http\Resources\LoginAuthResource;
use App\Modules\Auth\Repositories\LoginRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginController extends Controller
{

    public function __construct(private LoginRepository $loginRepository)
    {}

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Login Admin",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string", format="email", example="admin@admin.com"),
     *             @OA\Property(property="password", type="string", format="password", example="P$ssw0rd")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="user", type="object", ref="#/components/schemas/LoginAuthResource"),
     *             @OA\Property(property="authorization", type="object",
     *                 @OA\Property(property="access_token", type="string"),
     *                 @OA\Property(property="type", type="string"),
     *                 @OA\Property(property="expires_in", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response=400, 
     *          description="Invalid request",
     *          @OA\JsonContent(
     *             type="object",
     *              @OA\Property(property="message", type="string", example="invalid Credentials"),
     *          )
     *     )
     * 
     * )
     */
    public function login(LoginAuthRequest $loginAuthRequest): JsonResponse
    {
        $result = $this->loginRepository->login($loginAuthRequest->validated());
        $data = [
            'user' => new LoginAuthResource($result['user']),
            'authorization' => [
                'access_token' => $result['access_token'],
                'type' => 'bearer',
                'expires_in' => Carbon::now()->addMinutes(Auth::guard('api')->factory()->getTTL())->format('Y/m/d H:i:s')                    
            ]
        ];
        return $this->successResponse($data, ResponseAlias::HTTP_OK, '');
    }
}
