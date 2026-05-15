<?php

namespace App\Http\Controllers;

use App\Speciality;
use App\User;
use Illuminate\Http\Request;
use App\Location;

class AllCitiesExtendedDoctorController extends Controller
{
    //
    public function index(){

        $datas = Speciality::with('locations')->with('user')->get();

        return view('back-end.admin.extendeddoctors.index', compact('datas'));
    }
}
