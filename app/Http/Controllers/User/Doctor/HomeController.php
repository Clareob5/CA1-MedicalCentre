<?php

namespace App\Http\Controllers\User\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Visit;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('role:doctor');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
   public function index()
 {
   $patient = Patient::all();
   $cancelled = Visit::withTrashed()->get();
   return view('user.doctors.home', [
     'patient' => $patient,
     'cancelled' => $cancelled
   ]);
}

}
