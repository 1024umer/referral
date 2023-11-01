<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Api\{
    UserController,
    ProfileController,
    RoleController,
    ReferralController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['json.response']], function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
});
Route::group(['middleware' => ['json.response', 'auth:sanctum']], function () {
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::put('/updateprofile', [ApiAuthController::class, 'updateprofile']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('profiles', ProfileController::class);
    Route::get('/referrals',[ReferralController::class,'index']);
    Route::get('/referrals-show/{id}',[ReferralController::class,'show']);
});
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    User::where('id', $request->user()->id)
    ;
    return $request->user();
});