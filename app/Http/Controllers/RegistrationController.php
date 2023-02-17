<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    function create() 
    {
        return view('front.registration.create');
    }

    function store(Request $request) 
    {
        // Validation
        $request->validate([
            'nid' => 'required',
            'dob' => 'required',
            'phone' => 'required',
            'center' => 'required',
        ]);

        // Register user
        
        // $request->input('form-field-name');
        return view('front.registration.success');
    }
}
