<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorScheduleController extends Controller
{
    public function index(Doctor $doctor)
    {
        $doctor->load('user', 'speciality');

        return view('admin.doctors.schedules', compact('doctor'));
    }
}
