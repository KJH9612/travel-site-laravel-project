<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $filltable = [
        'gubuns_id',
        'name',
        'price',
        'jaego',
        'pic'
    ]
}
