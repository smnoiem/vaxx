<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    public function doses()
    {
        return $this->hasMany(Dose::class);
    }

    public function vaccineStocks()
    {
        return $this->hasMany(CenterVaccineStock::class);
    }
}