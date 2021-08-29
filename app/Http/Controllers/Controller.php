<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @SWG\Swagger(
 *   basePath="",
 *   schemes= {"http", "https"},
 *   host = L5_SWAGGER_CONST_HOST,
 *   @SWG\Info(
 *     version="1.0.0",
 *     title="Swagger Integration with PHP Laravel",
 *     description="Integrate Swagger in Laravel application",
 *   @SWG\Contact(
 *          email="amanvermame786@gmail.com"
 *     ),
 *   )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
