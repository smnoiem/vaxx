<?php

namespace App\Http\Controllers\Operator;

use App\Http\Requests\ShowRegistrationStatusRequest;
use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Dose;
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

        if ($registration) {
            return view('front.registration.success');
        } else {
            return view('front.registration.failure');
        }

    }

    function statusForm()
    {
        return view('front.registration.status-form');
    }

    function showStatus(ShowRegistrationStatusRequest $request)
    {
        $validated = $request->validated();

        $registration = Registration::where('nid', $validated['nid'])
            ->where('dob', $validated['dob'])
            ->where('phone', $validated['phone'])
            ->firstOrFail();

        return view('front.registration.status', compact('registration'));
    }
}