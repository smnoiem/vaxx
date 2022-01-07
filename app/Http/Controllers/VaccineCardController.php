<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccineCardController extends Controller
{
    function showForm () {
        return view('vaccine-card-form');
    }

    function generateVaccineCard (Request $request) {

        // validate
        return view('vaccine-card');
    }
}
