<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAreas extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_code',
        'area_name',
        'geom'
    ];
}
