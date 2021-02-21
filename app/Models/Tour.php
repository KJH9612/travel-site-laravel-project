<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
	protected $fillable = [
		'name', 'context', 'pic1', 'pic2', 'city_id'
	];
}
