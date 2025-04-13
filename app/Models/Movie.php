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
