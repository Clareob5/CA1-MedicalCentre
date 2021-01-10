<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_admin = Role::where('name', 'admin')->first();
      $role_user = Role::where('name', 'user')->first();
      $role_doctor = Role::where('name', 'doctor')->first();
      $role_patient = Role::where('name', 'patient')->first();



      $admin = new User();
      $admin->name = 'Clare OB';
      $admin->address = 'Dunleary House';
      $admin->phone = '0875643524';
      $admin->email = 'admin@cobmedcentre.com';
      $admin->password = Hash::make('secret');
      $admin->save();
      $admin->roles()->attach($role_admin);

      $user = new User();
      $user->name = 'Joe Cole';
      $user->address = 'Foxrock Grove';
      $user->phone = '0871234666';
      $user->email = 'cole@medcenter.com';
      $user->password = Hash::make('secret');
      $user->save();
      $user->roles()->attach($role_doctor);

      $doctor = new Doctor();
      $doctor->date_started = '2020-11-01';
      $doctor->user_id = $user->id;
      $doctor->save();

      $user = new User();
      $user->name = 'Naim Woods';
      $user->address = 'Ballymore Bridge';
      $user->phone = '0871223457';
      $user->email = 'naim@gmail.com';
      $user->password = Hash::make('secret');
      $user->save();
      $user->roles()->attach($role_patient);

      $patient = new Patient();
      $patient->has_insurance = true;
      $patient->policy_num = '235463';
      $patient->user_id = $user->id;
      $patient->med_insurance_id = 1;
      $patient->save();

      for($i = 1; $i <= 10; $i++){
        $user = User::factory()->hasDoctor()->create();
        $user->roles()->attach($role_doctor);

    }

    for($i = 1; $i <= 10; $i++){
      $user = User::factory()->hasPatient()->create();
      $user->roles()->attach($role_patient);

  }

      // $user = new User();
      // $user->name = 'Dr. Kelly';
      // $user->address = 'Fake Street';
      // $user->phone = '0871234123';
      // $user->email = 'kelly@medcenter.com';
      // $user->password = Hash::make('secret');
      // $user->save();
      // $user->roles()->attach($role_user);

      // $doctor = new Doctor();
      // $doctor->date_started = '07-06-2015';
      // $doctor->user_id = $user->id;
      // $doctor->save();


      // $patient = new User();
      // $patient->name = 'Joe Dempsey';
      // $patient->address = 'Elm Park, Athlone';
      // $patient->phone = '0875633324';
      // $patient->email = 'patient@cobbookstore.com';
      // $patient->password = Hash::make('secret');
      // $patient->save();
      // $patient->roles()->attach($role_patient);


    }
}
