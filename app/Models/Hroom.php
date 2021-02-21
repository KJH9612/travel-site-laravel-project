<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hroom extends Model
{
    use HasFactory;

	protected $fillable = [
        'hotel_id',
        'bed',
        'bathroom',
        'price',
		'type',
		'size',
		'pic'
    ];
}
