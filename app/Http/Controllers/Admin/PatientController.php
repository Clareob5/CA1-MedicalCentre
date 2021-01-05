<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\User;
use App\Models\MedInsurance;
use Hash;

class PatientController extends Controller
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
    $patients = Patient::all();
    return view('admin.patients.index', [
      'patients' => $patients,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
       $patients = Patient::all();
       $med_insurances = MedInsurance::all();
       return view('admin.patients.create', [
         'patients' => $patients,
         'med_insurances' => $med_insurances
       ]);
   }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:191',
      'address' => 'required|max:191',
      'phone' => 'required|max:11',
      'email' => 'required|email',
      'has_insurance' => 'boolean',
      'med_insurance_id' => 'nullable',
      'policy_num' => 'min:1|max:15|nullable'
    ]);
    $user = new User();
    $user->name = $request->input('name');
    $user->address = $request->input('address');
    $user->phone = $request->input('phone');
    $user->email = $request->input('email');
    $user->password = Hash::make('secret');
    $user->save();

    $patient = new Patient();
    $patient->has_insurance = $request->input('has_insurance');
    $patient->policy_num = $request->input('policy_num');
    $patient->user_id = $user->id;
    $patient->med_insurance_id = $request->input('med_insurance_id');
    $patient->save();

    $request->session()->flash('success', 'Patient Added Successfully');

    return redirect()->route('admin.patients.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $patient = Patient::findOrFail($id);
      $doctor = Doctor::all();
      return view('admin.patients.show', [
        'patient' => $patient,
        'doctor' => $doctor
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
    $patient = Patient::findOrFail($id);
    $med_insurances = MedInsurance::all();
    return view('admin.patients.edit', [
      'patient' => $patient,
      'med_insurances' => $med_insurances
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
      'name' => 'required|max:191',
      'address' => 'required|max:191',
      'phone' => 'required|max:11',
      'email' => 'required|email',
      'has_insurance' => 'boolean',
      'med_insurance_id' => 'nullable',
      'policy_num' => 'nullable|max:9',
      ]);

    $patient = Patient::findOrFail($id);
    $patient->user->name = $request->input('name');
    $patient->user->address = $request->input('address');
    $patient->user->phone = $request->input('phone');
    $patient->user->email = $request->input('email');
    $patient->has_insurance = $request->input('has_insurance');
    $patient->med_insurance_id = $request->input('med_insurance_id');
    $patient->policy_num = $request->input('policy_num');
    $patient->save();

    $request->session()->flash('info', 'Patient Edited Successfully');

    return redirect()->route('admin.patients.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $id)
  {
    $patient = Patient::findOrFail($id);
    $patient->delete();

    $request->session()->flash('danger', 'Patient Deleted Successfully');

    return redirect()->route('admin.patients.index');
  }
}
