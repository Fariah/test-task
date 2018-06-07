<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin = \App\User::create([
            'name' => 'Admin',
            'email' => config('app.admin_email'),
            'password' => \Illuminate\Support\Facades\Hash::make(config('app.admin_password'))
        ]);

        $role = Role::create(['name' => \App\User::ADMIN_ROLE]);
        $permission = Permission::create(['name' => 'all access']);
        $role->givePermissionTo($permission);

        $admin->assignRole(\App\User::ADMIN_ROLE);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\User::where('email', '=', config('app.admin_email'))->delete();
    }
}
