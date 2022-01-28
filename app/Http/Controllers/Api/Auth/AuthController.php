<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthFormRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param AuthFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(AuthFormRequest $request)
    {
        $client = Client::where('email', $request->email)->firstorFail();

        if (!$client || !Hash::check($request->password, $client->password)) {
            return response()->json(['message' => 'Credencias Inválidas!'], 404);
        }

        $token = $client->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function me(Request $request)
    {
        // Retorna o user autenticado
        $client = $request->user();

        return new ClientResource($client);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $client = $request->user();

        // Revoke all tokens client...
        $client->tokens()->delete();

        return response()->json([], 204);
    }
}
