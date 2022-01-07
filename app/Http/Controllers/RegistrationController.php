<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    function create() 
    {
        return view('registration');
    }

    function store(Request $request) 
    {

        // Process the registration form data
        // $request->input('form-field-name');
        return $request->input('nid');
    }
}
