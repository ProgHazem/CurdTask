<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser{

    /**
     * @param $data
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data, int $code, $message = null, ): JsonResponse
    {
        return response()->json([
            'status'=> trans('AuthLocalization::general.success'),
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse($error, int $code, $message = null): JsonResponse
    {
        return response()->json([
            'status'=>trans('AuthLocalization::general.error'),
            'message' => $message,
            'error' => $error
        ], $code);
    }

}
