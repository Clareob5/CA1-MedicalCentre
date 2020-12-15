<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {

           $role_admin = new Role();
           $role_admin->name = 'admin';
           $role_admin->description = 'An administrator user';
           $role_admin->save();

           $role_user = new Role();
           $role_user->name = 'user';
           $role_user->description = 'A user in the medical center';
           $role_user->save();

           $role_doctor = new Role();
           $role_doctor->name = 'doctor';
           $role_doctor->description = 'A doctor in the medical center';
           $role_doctor->save();

           $role_doctor = new Role();
           $role_doctor->name = 'patient';
           $role_doctor->description = 'A patient in the medical center';
           $role_doctor->save();
     }
}
