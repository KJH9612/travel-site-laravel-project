<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
	protected $fillable = [
		'name',
        'pic',
        'nation_id',
        'adult_price',
        'kid_price',
        'baby_price',
        'explain',
        'departure_date',
        'arrival_date',
        'departure_schedule_id',
        'arrival_schedule_id',
        'star'

	];
}
