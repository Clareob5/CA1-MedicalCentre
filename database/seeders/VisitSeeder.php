<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Visit;

class VisitSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i = 1; $i <= 10; $i++){
        $visit = Visit::factory()->forDoctor()->create();
        $visit = Visit::factory()->forPatient()->create();

    }
    }
}
