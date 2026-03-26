<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

class SecurityController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = $user->createToken('personal access token')->plainTextToken;

        return response()->json([
            'message' => 'utilisateur créer avec succes',
            'token' => $token,
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $validatedData = $request->validated();

        if(auth()->attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ]))
        {
            $user = auth()->user();
            $token = $user->createToken('personal access token')->plainTextToken; 
            
            return response()->json([
                'message' => 'connexion reussie',
                'token' => $token,
            ]);
        }

    }

    public function logout()
    {

    }
}
