<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//para poder usar funcao de criar hash
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //criar a função de registro
    public function register(Request $request){
        //validando os campos
        $fields = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|string|unique:users|email',
            'password'  => 'required|string|confirmed'
        ]);

        $user = User::create([
             'name'     => $fields['name'],
             'email'    => $fields['email'],
             'password' => bcrypt($fields['password'])
        ]);

        //faz a chamada da model que foi adicionado o token
        //devolve o token para autenticação da api
        $token = $user->createToken($request->nameToken)->plainTextToken;

        $response = [
            'name'  => $user ,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function login(Request $request){
        //validando dados recebidos
        $fields = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string'
        ]);

        //consulta com where do email e tras com first() o primeiro registro apenas
        $user = User::where('email' , $fields['email'])->first();
        $teste = $user->password ;
        if(!$user || !Hash::check($fields['password'] , $user->password) ){
            return response([
                'messagem'  => 'Email ou senha invalidos'
            ],401);
        }

        $token = $user->createToken('UsuarioLogado')->plainTextToken;
        $response = [
            'name'  => $user ,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function logout(Request $request){

        //deleta a tabela personal_access_tokens que é criada automatica pelo framework

        $logout = auth()->user()->tokens()->delete();
        if(!$logout){
            return response([
                'message'   => 'Problemas ao realizar Logout'
            ], 400);
        }
        return response([
            'message'   => 'Logout realizado'
        ], 200);


        // Revoke the token that was used to authenticate the current request...
        //$request->user()->currentAccessToken()->delete();

        // Revoke a specific token...
        //$user->tokens()->where('id', $tokenId)->delete();
    }

}
