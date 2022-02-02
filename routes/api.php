<?php

use App\Http\Controllers\Api\{Auth\AuthController,
    Auth\RegisterController,
    EvaluationApiController,
    OrderApiController,
    ProductApiController,
    TableApiController,
    TenantApiController,
    CategoryApiController};
use Illuminate\Support\Facades\Route;

Route::post('/sanctum/token', [AuthController::class, 'auth']);

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::post(env('API_VERSION').'/auth/order', [OrderApiController::class, 'store']);

    Route::post(env('API_VERSION').'/auth/order/{identifyOrder}/evaluation', [EvaluationApiController::class, 'store']);
});

Route::group([
    'prefix' => env('API_VERSION')
], function () {
    Route::post('/client', [RegisterController::class, 'store']);

    Route::get('/tenants', [TenantApiController::class, 'index']);
    Route::get('/tenant/{uuid}', [TenantApiController::class, 'show']);

    Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);
    Route::get('/category/{identify}', [CategoryApiController::class, 'show']);

    Route::get('/tables', [TableApiController::class, 'tablesByTenant']);
    Route::get('/table/{identify}', [TableApiController::class, 'show']);

    Route::get('/products', [ProductApiController::class, 'productsByTenantAndCategories']);
    Route::get('/product/{identify}', [ProductApiController::class, 'show']);

    Route::post('/order', [OrderApiController::class, 'store']);
    Route::get('/order/{identify}', [OrderApiController::class, 'show']);
});
