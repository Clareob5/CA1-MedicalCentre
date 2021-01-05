<?php

namespace App\Http\Controllers\User\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Visit;

class VisitController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('role:patient');
  }

  public function destroy($id)
  {
    $visit = Visit::findOrFail($id);
    $visit->delete();

    return redirect()->route('user.patients.home');
  }
}
