<?php

use App\Http\Controllers\Api\{Auth\AuthController,
    Auth\RegisterController,
    ProductApiController,
    TableApiController,
    TenantApiController,
    CategoryApiController};
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
Route::post('/sanctum/token', [AuthController::class, 'auth']);

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::post('/auth/me', [AuthController::class, 'me']);
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::post('/client', [RegisterController::class, 'store']);

    Route::get('/tenants', [TenantApiController::class, 'index']);
    Route::get('/tenant/{uuid}', [TenantApiController::class, 'show']);

    Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);
    Route::get('/category/{url}', [CategoryApiController::class, 'show']);

    Route::get('/tables', [TableApiController::class, 'tablesByTenant']);
    Route::get('/table/{identify}', [TableApiController::class, 'show']);

    Route::get('/products', [ProductApiController::class, 'productsByTenantAndCategories']);
    Route::get('/product/{flag}', [ProductApiController::class, 'show']);
});
