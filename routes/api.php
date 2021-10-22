<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\TurnController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    // 'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', [AuthController::class, "login"]);
    Route::post('logout', [AuthController::class, "logout"]);
    Route::post('refresh', [AuthController::class, "refresh"]);
    Route::post('me', [AuthController::class, "me"]);
});

Route::put("user/state/{id}", [UserController::class, "changeState"]);
Route::resource("user", UserController::class);

Route::get("role/permits", [RoleController::class, "listPermits"]);
Route::put("role/state/{id}", [RoleController::class, "changeState"]);
Route::resource("role", RoleController::class);

Route::put("publication/state/{id}", [PublicationController::class, "changeState"]);
Route::resource("publication", PublicationController::class);


Route::put("profession/state/{id}", [ProfessionController::class, "changeState"]);
Route::resource("profession", ProfessionController::class);


Route::put("specialty/state/{id}", [SpecialtyController::class, "changeState"]);
Route::resource("specialty", SpecialtyController::class);


Route::get("home", [HomeController::class, "index"]);

Route::resource("turn", TurnController::class);
