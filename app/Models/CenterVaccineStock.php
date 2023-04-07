<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterVaccineStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_id',
        'vaccine_id',
        'quantity',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }
}