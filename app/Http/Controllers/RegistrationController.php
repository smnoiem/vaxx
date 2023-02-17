<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Registration;

class RegistrationController extends Controller
{
    function create() 
    {
        return view('front.registration.create');
    }

    function store(StoreRegistrationRequest $request) 
    {
        $validated = $request->validated();

        $registration = Registration::create($validated);
        
        if($registration) {
            return view('front.registration.success');
        }
        else {
            return view('front.registration.failure');
        }
        
    }
}
