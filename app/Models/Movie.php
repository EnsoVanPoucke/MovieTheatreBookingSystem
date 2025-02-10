<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    protected $primaryKey = 'movie_id'; // Tell Laravel that 'movie_id' is the primary key

    protected $fillable = [
        'title',
        'description',
        'duration',
        'director',
        'cast',
        'genre',
        'price',
        'release_date',
        'image_url',
        'trailer_url'
    ];

    public function showtimes() {
        return $this->hasMany(\App\Models\Showtime::class, 'movie_id', 'movie_id');
    }
}
