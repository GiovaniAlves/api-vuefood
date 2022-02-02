<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEvaluationFormRequest;
use App\Http\Resources\EvaluationResource;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class EvaluationApiController extends Controller
{
    /*** @var EvaluationService */
    protected $evaluationService;

    /**
     * @param EvaluationService $evaluationService
     */
    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    /**
     * Para criar uma avaliação saõ necessários [id do pedido, id do cliente e as info da avaliação]
     * @param StoreEvaluationFormRequest $request
     * @param $identifyOrder
     * @return EvaluationResource
     */
    public function store(StoreEvaluationFormRequest $request, $identifyOrder)
    {
        $evaluation = $this->evaluationService->storeNewEvaluationOrder($identifyOrder, $request->all());

        return new EvaluationResource($evaluation);
    }

    public function show()
    {

    }
}
