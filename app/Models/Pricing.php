<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model {

	use HasFactory;

	public $timestamps = false;

	protected $fillable = [
		'movie_id',
		'single_seat_price',
		'duo_seat_price',
	];

	public function movie() {
		return $this->belongsTo(Movie::class, 'movie_id');
	}
}
