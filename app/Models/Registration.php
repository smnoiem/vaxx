<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nid',
        'dob',
        'phone',
        'center_id',
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class, 'nid', 'nid');
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function doses()
    {
        return $this->hasMany(Dose::class, 'recipient_nid', 'nid');
    }
}
