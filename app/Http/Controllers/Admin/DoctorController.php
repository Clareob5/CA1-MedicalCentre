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
    $doctors = Doctor::all(); //querying the database by using the model for doctors to retreive all doctors
    //returning the index for doctors with a variable to access all doctors
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
       return view('admin.doctors.create', [
         'doctors' => $doctors,
       ]);
   }

  public function store(Request $request) //stores the created doctor into the database
  {
    //below are validation rules for each of the separate inputs
    $request->validate([
      'name' => 'required|max:191',
      'address' => 'required|max:191',
      'phone' => 'required|max:11',
      'email' => 'required|email',
      'date_started' => 'required|date',
    ]);
    //gives each user attribute the value from the input field
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
    //sends a flash message to let you know the doctor was added successfully
    $request->session()->flash('success', 'Doctor Added Successfully');

    return redirect()->route('admin.doctors.index'); //redirects back to index page once form is submitted
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) //passes id from the selected doctor
  {
      $doctor = Doctor::findOrFail($id); //finds that doctor in the database by querying through the model
      //returns the view with chosen doctor
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
  public function update(Request $request, $id) //this updates the doctors info after it has been edited
  {
    //
    $request->validate([
      'name' => 'required|max:191',
      'address' => 'required|max:191',
      'phone' => 'required|max:15',
      'email' => 'required|email',
      'date_started' => 'required|date',
    ]);

    //this findorfail instead of new user and doctor because its updating an existing field
    $doctor = Doctor::findOrFail($id);
    $doctor->user->name = $request->input('name');
    $doctor->user->address = $request->input('address');
    $doctor->user->phone = $request->input('phone');
    $doctor->user->email = $request->input('email');
    $doctor->date_started = $request->input('date_started');
    $doctor->save();

    $request->session()->flash('info', 'Doctor Edited Successfully'); //sends confirmation message

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
    $doctor = doctor::findOrFail($id); //finds the doctor where its stored in the database and deletes them
    $doctor->delete();

    $request->session()->flash('danger', 'Doctor Deleted Successfully'); //sends confirmation message

    return redirect()->route('admin.doctors.index');
  }
}
