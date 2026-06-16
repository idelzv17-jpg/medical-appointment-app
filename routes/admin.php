<?php

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

//candado directo y explicito en este archivo
Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
  
    
    Route:: get ('/',function(){
        return view('admin.dashboard');
    })->name('dashboard');

    //Gestion de roles
    Route::resource('roles', RoleController::class);

    //Gestion de usuarios
    Route::resource('users', UserController::class);

    //Gestion de pacientes
    Route::resource('patients', PatientController::class);

    //Gestion de doctores
    Route::resource('doctors', DoctorController::class);
    Route::get('doctors/{doctor}/schedules', [DoctorScheduleController::class, 'index'])
        ->name('doctors.schedules');

    //Gestion de citas
    Route::get('appointments/calendar', [AppointmentController::class, 'calendar'])
        ->name('appointments.calendar');
    Route::resource('appointments', AppointmentController::class);
    Route::get('appointments/{appointment}/consultation', [AppointmentController::class, 'consultation'])
        ->name('appointments.consultation');

    //Gestion de seguros
    Route::resource('insurances', InsuranceController::class);

});  