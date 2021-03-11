<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPermissionRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $id_role_admin = DB::table('roles')->insertGetId(
            array(
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrador do sistema'
            )
        );

        $id_role_cliente = DB::table('roles')->insertGetId(
            array(
                'name' => 'Cliente',
                'slug' => 'cliente',
                'description' => 'Cliente do sistema'
            )
        );

        $id_permission_admin = DB::table('permissions')->insertGetId(
            array(
                'name'        => 'user',
                'slug'        => '{"create":true,"view":true,"update":true,"delete":true}',
                'description' => 'Permissões do admin'
            )
        );

        $id_permission_cliente = DB::table('permissions')->insertGetId(
            array(
                'name'        => 'user',
                'slug'        => '{"create":false,"view":true,"update":true,"delete":false}',
                'description' => 'Permissões do cliente'
            )
        );

        DB::table('permission_role')->insert(
            array(
                'permission_id' => $id_permission_admin,
                'role_id' => $id_role_admin
            ),
            array(
                'permission_id' => $id_permission_cliente,
                'role_id' => $id_role_cliente
            )
        );

        $id_user = DB::table('users')->insertGetId(
            array(
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('teste123')
            )
        );

        DB::table('role_user')->insert(
            array(
                'role_id' => $id_role_admin,
                'user_id' => $id_user
            )
        );


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('users')->truncate();
        DB::table('role_user')->truncate();
    }
}
