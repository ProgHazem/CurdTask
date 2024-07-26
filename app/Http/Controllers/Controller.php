<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ApiResponser;
use OpenApi\Annotations as OA;

/**
    * @OA\SecurityScheme(
        *    securityScheme="bearerAuth",
        *    in="header",
        *    name="bearerAuth",
        *    type="http",
        *    scheme="bearer",
        *    bearerFormat="JWT",
        * )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponser;
}
