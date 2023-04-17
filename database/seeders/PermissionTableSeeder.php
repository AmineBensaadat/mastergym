<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            // start dashboard of dashboard module
            'dashboard-nav',
            // end dashboard of dashboard module

            // start permisssion of members module
            'member-nav',
            'member-all-menu',
            'member-expired-menu',
            'member-create-menu',
            'member-add-button',
            'member-import-button',
            // end permisssion of members module

            // start role of role module
            'role-list-menu',
            'role-create',
            'role-edit',
            'role-delete',
            // end role of role

            // start coach of coach module
            'coach-nav',
            'coach-all-menu',
            'coach-create-menu',
            'coach-add-button',
            // end coach of coach

            // start gym of gym module
            'gym-nav',
            'gym-all-menu',
            'gym-create-menu',
            'gym-add-button',
            // end gym of gym 

            // start plans of plans module
            'plans-nav',
            'plans-all-menu',
            'plans-create-menu',
            'plans-add-button',
            // end plans of plans 
            
            // start services of services module
            'services-nav',
            'services-all-menu',
            'services-create-menu',
            'services-add-button',
            // end services of services 

            // start users of users module
            'users-nav',
            'users-all-menu',
            'users-create-menu',
            'users-add-button',
            // end services of service

            // start subscriptions of subscriptions module
            'subscriptions-nav',
            'subscriptions-all-menu',
            // end subscriptions of subscriptions

            // start invoices of invoices module
            'invoices-nav',
            // end invoices of invoices

            // start setting of setting module
            'setting-nav'
            // end setting of setting
            
            ];
            foreach ($permissions as $permission) {
            Permission  ::create(['name' => $permission]);
            }
            
    }
}
