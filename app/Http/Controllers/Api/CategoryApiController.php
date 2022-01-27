<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EntityByTenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /*** @var CategoryService */
    protected $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param EntityByTenantFormRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function categoriesByTenant(EntityByTenantFormRequest $request)
    {
        $categories = $this->categoryService->getCategoriesByTenantUuid($request->token_company);

        return CategoryResource::collection($categories);
    }

    /**
     * @param EntityByTenantFormRequest $request
     * @param $url
     * @return CategoryResource
     */
    public function show(EntityByTenantFormRequest $request, $url)
    {
        $category = $this->categoryService->getCategoryByUrl($url);

        return new CategoryResource($category);
    }
}
