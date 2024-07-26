<?php

namespace App\Modules\Auth\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OpenApi\Annotations as OA;

class LogoutController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/v1/auth/logout",
     *     summary="Logout Admin",
     *     tags={"Authentication"},
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer token for authentication",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="Bearer your_access_token_here"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Successfully logged out")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="invalid Token")
     *         )
     *     )
     * )
     */
    public function logout(): JsonResponse
    {
        if (!Auth::guard('api')->check()){
            throw new NotFoundHttpException(trans('AuthLocalization::general.auth.invalidToken'));
        }
        Auth::guard('api')->logout();
        return $this->successResponse([], ResponseAlias::HTTP_OK, trans('AuthLocalization::general.logout'));
    }
}
