<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline_reservation extends Model
{
    use HasFactory;
	
	protected $fillable = [
		'consumers_id',
		'schedules_id',
		'adult',
		'child',
		'infant',
		'total',
		'baggage'
	];
}
