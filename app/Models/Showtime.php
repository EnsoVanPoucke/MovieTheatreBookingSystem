<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showtime extends Model {
	// protected $primaryKey = 'showtime_id'; // If 'showtime_id' is the primary key

	public $timestamps = false; // Set to true if you have timestamps

	public function movie() {
		return $this->belongsTo(\App\Models\Movie::class, 'movie_id', 'movie_id');
	}

	// public function screenroom() {
	// 	return $this->belongsTo(Screenroom::class, 'screenroom_id');
	// }

}
