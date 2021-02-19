<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\VentaController;

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
Route::prefix('users')->group(function () {

	Route::post('/registro',[UserController::class, 'createUser']);
	Route::post('/login',[UserController::class, 'Login']);
	Route::post('/recuperarcontrasena',[UserController::class, 'resetPassword']);
});
Route::prefix('cards')->group(function () {

    Route::post('/create',[CardController::class, 'createCard'])->middleware('guest');
});

Route::prefix('collections')->group(function () {

    Route::post('/update',[CollectionController::class, 'updateCollection']);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('ventas')->group(function () {

	Route::post('/crearventa',[VentaController::class, 'createVenta'])->middleware('auth');
	Route::get('/listado/{cardname}',[VentaController::class, 'cardsList']);

});
Route::prefix('compras')->group(function () {

	Route::get('/comprar/{cardname}',[VentaController::class, 'listacompra']);
	
});
