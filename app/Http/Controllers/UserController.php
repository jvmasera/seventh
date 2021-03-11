<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function update(Request $request, $userId){

        //Validando Campos
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'role' => 'required'
        ]);

        //Buscando o Usuário informado e atualizando as informações
        $user = User::find($userId);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        //Removendo os grupos do usuário e assinando o informado
        $user->revokeAllRoles();
        $user->assignRole($request->input('role'));

        return $user;
    }

    public function logs(){
        return User::all()->authentications->paginate(30);
    }
}
