<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\ValidationException;

class AuthController extends Controller
{

    public function auth(AuthRequest $authRequest)
    {
        $user = User::where('email', $authRequest->email)->first();

        if (!$user || !Hash::check($authRequest->password, $user->password))
        {
            throw ValidationException::withMessage([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        $user->tokens()->delete(); // assim deleta de todos os dispositivos logados, ficando apenas no ultimo

        $token = $user->createToken($authRequest->device_name)->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json(['success' => true]);
    }
}
