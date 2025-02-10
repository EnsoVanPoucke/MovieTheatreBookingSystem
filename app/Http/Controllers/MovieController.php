<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller {

	public function index() {
		$movies = Movie::all();
		return view('movies', compact('movies'));
	}
	
	public function show($id) {
		// $movie = Movie::findOrFail($id);
		$movie = Movie::where('movie_id', $id)->firstOrFail(); // Correctly search by movie_id
		
		// Fetch upcoming showtimes for this movie
		$showtimes = $movie->showtimes()
		->where('showtime', '>=', Carbon::now()) // Get only future showtimes
		->orderBy('showtime')
		->get();
		
		// Extract unique upcoming dates
		$dates = $showtimes->map(function ($showtime) {
			return Carbon::parse($showtime->showtime)->toDateString();
		})->unique();
		
		return view('show', compact('movie', 'showtimes', 'dates'));
	}
}










// public function show($id) {
// 	// $movie = Movie::findOrFail($id); // findOrFail($id): This fetches the movie by movie_id, and if it doesn't exist, it throws a 404 error.
// 	// return view('show', compact('movie'));

// 	$movie = Movie::where('movie_id', $id)->firstOrFail(); // Correctly search by movie_id
// 	return view('show', compact('movie'));
// }