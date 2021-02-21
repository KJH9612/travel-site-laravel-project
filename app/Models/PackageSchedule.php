<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSchedule extends Model
{
    use HasFactory;
	protected $fillable = [
		'package_id',
        'date',
        'sort',
        'context',
        'type',
        'tour_id',
        'city_id',
        'hotel_id'
	];
}
