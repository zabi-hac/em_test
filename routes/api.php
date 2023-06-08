<?php

use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    //All secure URL's
    Route::apiResource('product', ProductApiController::class);

});





Route::post("login", [UserApiController::class, 'login']);
Route::post("register", [UserApiController::class, 'register']);





// Route::middleware(['auth'])->group(function () {
// });
