<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model {

	use HasFactory;

	public $timestamps = false;

	public function movie() {
		return $this->belongsTo(Movie::class, 'movie_id');
	}
}






// protected $table = 'pricing';

// protected $fillable = ['screening_date', 'screening_time', 'screen_number','tarief_single_normaal','tarief_single_korting','tarief_duo_normaal', 'tarief_duo_korting'];
// protected $fillable = ['movie_id', 'single_seat_price', 'duo_seat_price'];
