<?php

namespace App\Http\Requests\Api;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Se não estiver autenticado retorna false - mas o middleware já está validando tbm
        if (!$clientId = auth()->user()->id) {
            return false;
        }

        // Com o app() é feito um bind e eu não preciso fazer um new para criar um objeto da classe
        // Se eu passar uma ordem que não existe tbm já cai no false
        if (!$order = app(OrderRepositoryInterface::class)->getOrderByIdentify($this->identifyOrder)) {
            return false;
        }

        // Se sim retorna (true) senão (false) -> ou seja não posso avaliar o pedido de outra pessoa.
        return $clientId == $order->client_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|min:3|max:200
            ',
        ];
    }
}
