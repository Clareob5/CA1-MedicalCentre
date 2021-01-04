<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Visit;

class VisitController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('role:admin');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $visits = Visit::all();
    return view('admin.visits.index', [
      'visits' => $visits
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
       $visits = Visit::all();
       $patients = Patient::all();
       $doctors = Doctor::all();
       return view('admin.visits.create', [
         'visits' => $visits,
         'patients' => $patients,
         'doctors' => $doctors
       ]);
   }

  public function store(Request $request)
  {
    $request->validate([
      'date' => 'required|date|after:today',
      'start_time' => 'required|date_format:H:i',
      'end_time' => 'required|date_format:H:i',
      'duration' => 'required',
      'cost' => 'required|min:0|max:1000',
      'patient_id' => 'required',
      'doctor_id' => 'required'
    ]);
    $visit = new Visit();
    $visit->date = $request->input('date');
    $visit->start_time = $request->input('start_time');
    $visit->end_time = $request->input('end_time');
    $visit->duration = $request->input('duration');
    $visit->cost = $request->input('cost');
    $visit->patient_id = $request->input('patient_id');
    $visit->doctor_id = $request->input('doctor_id');
    $visit->save();

    return redirect()->route('admin.visits.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $visit = visit::findOrFail($id);

      return view('admin.visits.show', [
        'visit' => $visit
      ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $visit = Visit::findOrFail($id);
    $patients = Patient::All();
    $doctors = Doctor::All();

    return view('admin.visits.edit', [
      'visit' => $visit,
      'patients' => $patients,
      'doctors' => $doctors
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $request->validate([
      'date' => 'required|date|after:today',
      'start_time' => 'required|date_format:H:i',
      'end_time' => 'required|date_format:H:i',
      'duration' => 'required',
      'cost' => 'required|min:0|max:1000',
      'patient_id' => 'required',
      'doctor_id' => 'required'
    ]);
    $visit = Visit::findOrFail($id);
    $visit->date = $request->input('date');
    $visit->start_time = $request->input('start_time');
    $visit->end_time = $request->input('end_time');
    $visit->duration = $request->input('duration');
    $visit->cost = $request->input('cost');
    $visit->patient_id = $request->input('patient_id');
    $visit->doctor_id = $request->input('doctor_id');
    $visit->save();

      return redirect()->route('admin.visits.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $visit = Visit::findOrFail($id);
    $visit->delete();

    return redirect()->route('admin.visits.index');
  }
}
