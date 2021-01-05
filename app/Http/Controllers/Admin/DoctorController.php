<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Hash;

class DoctorController extends Controller
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
    $doctors = Doctor::all();
    return view('admin.doctors.index', [
      'doctors' => $doctors
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
       $doctors = Doctor::all();
       $users = User::all();
       return view('admin.doctors.create', [
         'doctors' => $doctors,
         'users' => $users
       ]);
   }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:191',
      'address' => 'required|max:191',
      'phone' => 'required|max:15',
      'email' => 'required|email',
      'date_started' => 'required|date',
    ]);
    $user = new User();
    $user->name = $request->input('name');
    $user->address = $request->input('address');
    $user->phone = $request->input('phone');
    $user->email = $request->input('email');
    $user->password = Hash::make('secret');
    $user->save();

    $doctor = new Doctor();
    $doctor->date_started = $request->input('date_started');
    $doctor->user_id = $user->id;
    $doctor->save();

    $request->session()->flash('success', 'Doctor Added Successfully');

    return redirect()->route('admin.doctors.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $doctor = Doctor::findOrFail($id);

      return view('admin.doctors.show', [
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
    $doctor = Doctor::findOrFail($id);

    return view('admin.doctors.edit', [
      'doctor' => $doctor
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
      'phone' => 'required|max:15',
      'email' => 'required|email',
      'date_started' => 'required|date',
    ]);

    $doctor = Doctor::findOrFail($id);
    $doctor->user->name = $request->input('name');
    $doctor->user->address = $request->input('address');
    $doctor->user->phone = $request->input('phone');
    $doctor->user->email = $request->input('email');
    $doctor->date_started = $request->input('date_started');
    $doctor->save();

    $request->session()->flash('info', 'Doctor Edited Successfully');

    return redirect()->route('admin.doctors.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request,$id)
  {
    $doctor = doctor::findOrFail($id);
    $doctor->delete();

    $request->session()->flash('danger', 'Doctor Deleted Successfully');

    return redirect()->route('admin.doctors.index');
  }
}
