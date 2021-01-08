<?php

namespace App\Http\Controllers\User\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

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
      $this->middleware('role:patient');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
   public function index()
 {
   $doctor = Doctor::all();
   return view('user.patients.home', [
     'doctor' => $doctor,
   ]);
}

}
