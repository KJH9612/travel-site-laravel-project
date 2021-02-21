<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageReservation extends Model
{
    use HasFactory;
	protected $fillable = [
		'package_id',
        'consumer_id',
        'adult',
        'kid',
        'baby',
        'total',
        'service_total',
        'package_total',
        'breakfast',
        'bedsize',
        'wifi',
        'airplaneup',
        'shuttle',
        'review',
	];
}
