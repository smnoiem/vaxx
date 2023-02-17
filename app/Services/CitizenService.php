<?php

namespace App\Services;

use App\Models\Citizen;

class CitizenService
{
    public function verifyNid($nid, $dob)
    {
        return Citizen::where('nid', $nid)->where('dob', $dob)->exists();
    }
}