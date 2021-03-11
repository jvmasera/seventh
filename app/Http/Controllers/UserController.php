<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Collection;
use DB;

class UserController extends Controller
{
    public function update(Request $request, $userId){

        //Validando Campos
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . $userId,
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
        $logs = DB::table('users')
            ->join('authentication_log', 'users.id', '=', 'authentication_log.authenticatable_id')
            ->select('users.name', 'authentication_log.ip_address', 'authentication_log.login_at')
            ->paginate(10);
        return $logs;
    }

    public function getUsers($userId){
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'roles.slug')
            ->where('users.id', '!=', $userId)
            ->paginate(10);
        return $users;
    }
}
