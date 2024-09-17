<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
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
}
