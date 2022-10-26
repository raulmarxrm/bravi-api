<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Registro de Usuario
     */

    public function register(Request $resquest)
    {
        $resquest->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed',
        ]);

        $user = User::create([
            'name'=> $resquest->name,
            'email'=>$resquest->email,
            'password'=>bcrypt($resquest->password),
        ]);

        $token = $user->createToken('primeirotoken')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string',
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'mensagem'=>'Credencial invalida'
            ],401);
        }

        $token = $user->createToken('primeirotoken')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token,
        ];

        return response($response, 201);
    }

    public function logouf(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response([
            'mensagem'=>'Logouf efetuado com o sucesso'
        ],401);
    }
}
