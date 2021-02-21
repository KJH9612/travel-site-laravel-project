<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'startDate',
		'endDate',
		'departure_id',
		'destnation_id',
		'air_id',
		'price'
	];
}
