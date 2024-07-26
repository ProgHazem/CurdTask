<?php

namespace App\Modules\Auth\Repositories;

use Exception;
use App\Modules\Auth\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Modules\Auth\Repositories\Interfaces\LoginInterface;

class LoginRepository implements LoginInterface
{
    /**
     * @param $data
     * @return array|JsonResponse
     * @throws Exception
     */
    public function login($data): JsonResponse|array
    {
        $user = User::where('email', strtolower($data['email']))->first();
        if (!$user) {
            throw new ModelNotFoundException(trans('AuthLocalization::general.auth.invalidCredentials'));
        }
        $credentials = [
            'email' => strtolower($user->email),
            'password' => $data['password']
        ];

        $access_token = Auth::guard('api')
            ->attempt($credentials);

        if (!$access_token) {
            throw new ModelNotFoundException(trans('AuthLocalization::general.auth.invalidCredentials'));
        }

        $user = Auth::guard('api')->user();      

        return [
            'user' => $user,
            'access_token' => $access_token,
        ];
    }
}
