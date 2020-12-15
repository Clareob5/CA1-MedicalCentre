<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\DoctorController as DoctorController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
Route::get('/user/doctor/home', [App\Http\Controllers\User\Doctor\HomeController::class, 'index'])->name('user.doctors.home');
Route::get('/user/patient/home', [App\Http\Controllers\User\Patient\HomeController::class, 'index'])->name('user.patients.home');

Route::get('/admin/doctors/index', [DoctorController::class, 'index'])->name('admin.doctors.index');
Route::get('/admin/doctor/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
Route::get('/admin/doctor/{id}', [DoctorController::class, 'show'])->name('admin.doctors.show');
Route::post('/admin/doctor/store', [DoctorController::class, 'store'])->name('admin.doctors.store');
Route::get('/admin/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
Route::put('/admin/doctors/{id}', [DoctorController::class, 'update'])->name('admin.doctors.update');
Route::delete('/admin/doctors/{id}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');

Route::get('/admin/patients/index', [DoctorController::class, 'index'])->name('admin.patients.index');

Route::get('/admin/visits/index', [DoctorController::class, 'index'])->name('admin.visits.index');
