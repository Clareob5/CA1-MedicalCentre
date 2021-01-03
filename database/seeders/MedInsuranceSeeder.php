<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedInsurance;

class MedInsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $med_insurance = new MedInsurance();
      $med_insurance->insurance_company = 'VHI Healthcare';
      $med_insurance->save();

      $med_insurance = new MedInsurance();
      $med_insurance->insurance_company = 'Irish Life Health';
      $med_insurance->save();

      $med_insurance = new MedInsurance();
      $med_insurance->insurance_company = 'Laya Healthcare';
      $med_insurance->save();

      $med_insurance = new MedInsurance();
      $med_insurance->insurance_company = 'HSF Health Plan';
      $med_insurance->save();
    }
}
