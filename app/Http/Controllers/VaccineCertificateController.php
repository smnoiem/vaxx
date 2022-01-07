<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaccineCertificateController extends Controller
{
    function showForm () {
        return view('vaccine-certificate-form');
    }

    function generateCertificate (Request $request) {

        // validate
        return view('vaccine-certificate');
    }
}
