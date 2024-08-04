<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

if (request()->header('Authorization')) {
    Route::middleware('auth:sanctum')->group(function () {
        Route::group(['prefix' => '/roles',], function () {
            Route::get('/all', [RoleController::class, 'getAllRoles']);
            Route::get('/permissions', [RoleController::class, 'getPermissions']);
            Route::get('/{role}', [RoleController::class, 'getRole']);
            Route::post('/store', [RoleController::class,'store']);
            Route::put('/update/{role}', [RoleController::class, 'update']);
            Route::delete('/delete/{role}', [RoleController::class, 'delete']);
        });

        Route::group(['prefix' => '/sizes',], function () {
            Route::get('/all', [SizeController::class, 'allSizes']);
            Route::get('/{size}', [SizeController::class, 'getSize']);
            Route::post('/store', [SizeController::class,'store']);
            Route::put('/update/{size}', [SizeController::class, 'update']);
            Route::delete('/delete/{size}', [SizeController::class, 'destroy']);
        });

        Route::group(['prefix' => '/colors',], function () {
            Route::get('/all', [ColorController::class, 'allColors']);
            Route::get('/{color}', [ColorController::class, 'getColor']);
            Route::post('/store', [ColorController::class,'store']);
            Route::put('/update/{color}', [ColorController::class, 'update']);
            Route::delete('/delete/{color}', [ColorController::class, 'destroy']);
        });

        Route::group(['prefix' => '/categories',], function () {
            Route::get('/all', [CategoryController::class, 'allCategories']);
            Route::get('/{category}', [CategoryController::class, 'getCategory']);
            Route::post('/store', [CategoryController::class,'store']);
            Route::put('/update/{category}', [CategoryController::class, 'update']);
            Route::delete('/delete/{category}', [CategoryController::class, 'destroy']);
        });

        Route::group(['prefix' => '/products',], function () {
            Route::get('/all', [ProductController::class, 'allProducts']);
            Route::get('/{product}', [ProductController::class, 'getProduct']);
            Route::post('/store', [ProductController::class,'store']);
            Route::put('/update/{product}', [ProductController::class, 'update']);
            Route::delete('/delete/{product}', [ProductController::class, 'destroy']);
        });
    });
}
else {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
}
