<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    public function operators()
    {
        return $this->hasMany(User::class, 'center_id', 'id');
    }
}
