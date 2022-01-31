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
    public function productsByTenantAndCategories(EntityByTenantFormRequest $request)
    {
        $products = $this->productService->getProductsByTenantUuidAndCategories(
            $request->token_company,
            // Se nenhuma categoria for passada recebo um array vazio e devolvo todas as categorias
            $request->get('categories', [])
        );

        return ProductResource::collection($products);
    }

    /**
     * @param EntityByTenantFormRequest $request
     * @param string $identify
     * @return ProductResource
     */
    public function show(EntityByTenantFormRequest $request, string $identify)
    {
        $product = $this->productService->getProductByUuid($identify);

        return new ProductResource($product);
    }
}
