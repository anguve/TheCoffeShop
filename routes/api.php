<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Roll\RollController;
use App\Http\Controllers\ToSell\ToSellController;
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

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ],
 Route::group(['middleware' => ['jwt.auth']], function(){

    Route::post('/logout', [AuthController::class, 'logout']);  
    
    Route::get('/producto', [ProductController::class,'getProducts']);
    Route::get('/producto/{id}', [ProductController::class,'getSingleProducts']);
    Route::post('/producto/crear', [ProductController::class,'createProducts']);
    Route::put('/producto/editar/{id}', [ProductController::class,'editProducts']);
    Route::put('/producto/borrar/{id}', [ProductController::class,'deleteProducts']);  
        
    Route::post('/admin/registro', [AdminController::class,'createAdminUsers']); 
    Route::get('/usuario', [UserController::class,'getUsers']);
    Route::get('/usuario/{id}', [UserController::class,'getSingleUsers']);
    Route::put('/usuario/editar/{id}', [AdminController::class,'editUsers']);
    Route::put('/usuario/borrar/{id}', [UserController::class,'deleteUsers']);  
    
    Route::get('/roll', [RollController::class,'getRolls']);
    Route::get('/roll/{id}', [RollController::class,'getSingleRolls']);
    Route::post('/roll/crear', [RollController::class,'createRolls']);
    Route::put('/roll/editar/{id}', [RollController::class,'editRolls']);
    Route::put('/roll/borrar/{id}', [RollController::class,'deleteRolls']); 
    
    Route::get('/venta', [ToSellController::class,'getToSells']); 
    Route::get('/venta/{id}', [ToSellController::class,'getSingleToSells']); 
    Route::post('/venta/crear', [ToSellController::class,'createToSells']); 
    
});


Route::post('/usuario/registro', [UserController::class,'createUsers']);
Route::post('/login', [AuthController::class, 'login']);