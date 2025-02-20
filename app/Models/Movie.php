<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

	protected $fillable = [
		'title',
		'description',
		'director',
		'cast',
		'genre',
		'duration',
		'release_date',
		'poster_url',
		'trailer_url'
	];

	public function screenings() {
		return $this->hasMany(Screening::class, 'movie_id');
	}
}





// public function screenings() {
// 	return $this->hasMany(\App\Models\Screening::class, 'id', 'id');
// }

// protected $primaryKey = 'movie_id'; // Tell Laravel that 'movie_id' is the primary key

// 'tarief_single_normaal',
// 'tarief_single_korting',
// 'tarief_duo_normaal',
// 'tarief_duo_korting',