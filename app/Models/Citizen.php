<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    public function registration()
    {
        return $this->hasOne(Registration::class, 'nid', 'nid');
    }
}
