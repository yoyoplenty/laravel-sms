<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="SMS API DOCUMENTATION",
 *      description="A simple laravel school management system for secondary schools",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 * 
 * @OA\Schema(
 *         schema="CreateStudent",
 *         required={"user_id","grade_id",},
 *         @OA\Property(property="id",description="id of the student",type="integer"),
 *         @OA\Property(property="user_id",description="user id",type="integer"),
 *         @OA\Property(property="grade_id",description="user id",type="integer"),
 * )
 * 
 */
class Controller extends BaseController {

    use AuthorizesRequests, ValidatesRequests;
}
