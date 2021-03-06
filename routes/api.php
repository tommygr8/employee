<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function (){
    Route::prefix('user')->group(function () {
        Route::post('/',[UserController::class,'add']);
        Route::delete('/{user_id}',[UserController::class,'delete']);
        Route::get('/{user_id}',[UserController::class,'edit']);
        Route::PATCH('/{user_id}',[UserController::class,'update']);
    });

});