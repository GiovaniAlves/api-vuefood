<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EntityByTenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;

class ProductApiController extends Controller
{
    /*** @var ProductService */
    protected $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param EntityByTenantFormRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function productsByTenant(EntityByTenantFormRequest $request)
    {
        $products = $this->productService->getProductsByTenantUuid($request->token_company);

        return ProductResource::collection($products);
    }
}
