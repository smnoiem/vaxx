<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccineStatusController extends Controller
{
    function showForm () {
        return view('vaccine-status-form');
    }

    function showVaccineStatus () {
        return view('vaccine-status');
    }
}
