<?php

use App\Http\Controllers\Api\{ProductApiController, TableApiController, TenantApiController, CategoryApiController};
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/tenants', [TenantApiController::class, 'index']);
Route::get('/tenant/{uuid}', [TenantApiController::class, 'show']);

Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);
Route::get('/categories/{url}', [CategoryApiController::class, 'show']);

Route::get('/tables', [TableApiController::class, 'tablesByTenant']);
Route::get('/tables/{identify}', [TableApiController::class, 'show']);

Route::get('/products', [ProductApiController::class, 'productsByTenant']);
