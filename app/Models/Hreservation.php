<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hreservation extends Model
{
    use HasFactory;

	protected $fillable = [
        'check_in',
        'check_out',
        'adult',
        'child',
		'price',
		'hotel_id',
		'breakfast',
		'bedsize',
        'wifiegg',
		'consumer_id',
		'hroom_id'
    ];
}
