<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;

/**
 *   @OA\Server(
 *      url="/"  
 *   ),
 *   @OA\Info(title="SECREAT_CLUB", version="0.1")
 * 
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   in="header",
 *   name="Authorization",
 *   type="apiKey",
 *   scheme="basic",
 *   bearerFormat="JWT",
 * )
 */
class ApiController extends Controller
{
    use ApiResponseTrait;
}
