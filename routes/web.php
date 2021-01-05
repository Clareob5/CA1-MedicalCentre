<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PatientController as PatientController;
use App\Http\Controllers\Admin\DoctorController as DoctorController;
use App\Http\Controllers\Admin\VisitController as VisitController;
use App\Http\Controllers\User\Doctor\VisitController as DoctorVisitController;
use App\Http\Controllers\User\Patient\VisitController as PatientVisitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home')->middleware('verified');
Route::get('/user/doctor/home', [App\Http\Controllers\User\Doctor\HomeController::class, 'index'])->name('user.doctors.home')->middleware('verified');
Route::get('/user/patient/home', [App\Http\Controllers\User\Patient\HomeController::class, 'index'])->name('user.patients.home')->middleware('verified');

Route::get('/admin/doctors/index', [DoctorController::class, 'index'])->name('admin.doctors.index');
Route::get('/admin/doctor/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
Route::get('/admin/doctor/{id}', [DoctorController::class, 'show'])->name('admin.doctors.show');
Route::post('/admin/doctor/store', [DoctorController::class, 'store'])->name('admin.doctors.store');
Route::get('/admin/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
Route::put('/admin/doctors/{id}', [DoctorController::class, 'update'])->name('admin.doctors.update');
Route::delete('/admin/doctors/{id}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');

Route::get('/admin/patients/index', [PatientController::class, 'index'])->name('admin.patients.index');
Route::get('/admin/patient/create', [PatientController::class, 'create'])->name('admin.patients.create');
Route::get('/admin/patient/{id}', [PatientController::class, 'show'])->name('admin.patients.show');
Route::post('/admin/patient/store', [PatientController::class, 'store'])->name('admin.patients.store');
Route::get('/admin/patient/{id}/edit', [PatientController::class, 'edit'])->name('admin.patients.edit');
Route::put('/admin/patient/{id}', [PatientController::class, 'update'])->name('admin.patients.update');
Route::delete('/admin/patient/{id}', [PatientController::class, 'destroy'])->name('admin.patients.destroy');


Route::get('/admin/visits/index', [VisitController::class, 'index'])->name('admin.visits.index');
Route::get('/admin/visit/create', [VisitController::class, 'create'])->name('admin.visits.create');
Route::get('/admin/visit/{id}', [VisitController::class, 'show'])->name('admin.visits.show');
Route::post('/admin/visit/store', [VisitController::class, 'store'])->name('admin.visits.store');
Route::get('/admin/visit/{id}/edit', [VisitController::class, 'edit'])->name('admin.visits.edit');
Route::put('/admin/visit/{id}', [VisitController::class, 'update'])->name('admin.visits.update');
Route::delete('/admin/visit/{id}', [VisitController::class, 'destroy'])->name('admin.visits.destroy');

Route::get('/doctor/visit/create', [DoctorVisitController::class, 'create'])->name('user.doctors.visits.create');
Route::get('/doctor/visit/{id}', [DoctorVisitController::class, 'show'])->name('user.doctors.visits.show');
Route::post('/doctor/visit/store', [DoctorVisitController::class, 'store'])->name('user.doctors.visits.store');
Route::get('/doctor/visit/{id}/edit', [DoctorVisitController::class, 'edit'])->name('user.doctors.visits.edit');
Route::put('/doctor/visit/{id}', [DoctorVisitController::class, 'update'])->name('user.doctors.visits.update');
Route::delete('/doctor/visit/{id}', [DoctorVisitController::class, 'destroy'])->name('user.doctors.visits.destroy');

Route::delete('/patient/visit/{id}', [PatientVisitController::class, 'destroy'])->name('user.patients.visits.destroy');
