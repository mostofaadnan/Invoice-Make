<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'name' => 'Adminastrator', 
        	'email' => 'admin@invmake.com',
            'password' => bcrypt('123456'),
            'status'=>'1',
            'image'=>'1603042204png'
        ]);
        $role = Role::create(['name' => 'adminastartor']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
