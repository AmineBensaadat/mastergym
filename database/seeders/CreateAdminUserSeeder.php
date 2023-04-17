<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'name' => 'abcf Shukla',
            'email' => 'amine@rscoder.com',
            'password' => bcrypt('123456'),
            'roles_name' => ['owner'],
            'Status' => 'active',
            ]);
            //$role = Role::create(['name' => 'owner']);
            // $permissions = Permission::pluck('id','id')->all();
            // $role->syncPermissions($permissions);
            // $user->assignRole([$role->id]);
            
    }
}
