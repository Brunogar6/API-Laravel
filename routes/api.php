<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::middleware('auth:sanctum')->group (function () {

    Route::apiResource('/videos', VideoController::class);

    Route::apiResource('/categorias', CategoriaController::class);

    Route::get('/categorias/{categoria}/videos', [CategoriaController::class, 'videos']) ->name('videos.index');
});

Route::get('/videos/free', [VideoController::class, 'free']) ->name('videos.free');

Route::post('/login', [LoginController::class, 'login']) ->name('login');
Route::post('/register', [RegisterController::class, 'create']) ->name('register');