<?php

use App\Http\Controllers\Api\{
    TenantApiController,
    CategoryApiController
};
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
