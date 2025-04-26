<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening extends Model {
	use HasFactory;

	protected $fillable = ['screening_date', 'screening_time', 'screen_number', 'movie_id', 'is_public'];

	public $timestamps = false;
	
	public function movie() {
		return $this->belongsTo(Movie::class, 'movie_id');
	}
}
