<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

	protected $fillable = [
        'name',
		'nation_id',
        'city_id',
        'gm_address',
        'address',
        'explain',
		'pic',
        'star',
		'geographic_id'
    ];

}
