<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Role;
use App\Models\Visit;
use App\Models\User;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_doctor = Role::where('name', 'doctor')->first();

      for($i = 1; $i <= 5; $i++){
          Doctor::factory()->hasVisits(rand(2,5))->create();

      }
        // $role_user = Role::where('name', 'user')->first();
        //
        // foreach($role_user->users as $user) {
        //   $doctor = new Doctor();
        //   $doctor->date_started = '20' . $this->random_str(1, '01') . $this->random_str(1, '0123456789') . '-' . '0' . $this->random_str(1, '123456789') . '-' .$this->random_str(1, '012') . $this->random_str(1, '0123456789');
        //   $doctor->user_id = $user->id;
        //   $doctor->save();
        //   //$user->roles()->attach($role_doctor);
        // }


   //  private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
   // {
   //   $pieces = [];
   //   $max = mb_strlen($keyspace, '8bit') - 1;
   //   for ($i = 0; $i < $length; ++$i) {
   //     $pieces []= $keyspace[random_int(0, $max)];
   //   }
   //   return implode('', $pieces);
   // }
}
}
