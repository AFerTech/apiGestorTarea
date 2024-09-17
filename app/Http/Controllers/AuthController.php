<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Obteniendo los datos que pasaron la validacion
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>bcrypt($data['password'])

        ]);

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'token' => $user->createToken('token')->plainTextToken,
            'data' => UserResource::make($user)
        ]);
    }

    public function login(LoginRequest $request){

        $data = $request->validated();

        // verificar usuario
        if(!Auth::attempt($data)){
            return response()->json([
                'error' => 'El correo o contraseña son incorrectos'
            ],422);
        }
        // autenticacion de usuario
        $user = Auth::user();
        return response()->json([
            'message' => 'Usuario autenticado correctamente',
            'token' => $user->createToken('token')->plainTextToken,
            'data'  => UserResource::make($user)
        ], 200);

    }

    
}
