<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
// use Illuminate\Http\Request;

class MovieController extends Controller {

	public function index() {
		$movies = Movie::all();
		return view('movies', compact('movies'));
	}

	public function show($id) {
		$movie = Movie::where('movie_id', $id)->firstOrFail();

		// Fetch upcoming showtimes for this movie
		$showtimes = $movie->showtimes()
			->where('show_date', '>=', Carbon::now()) // Get only future showtimes
			->orderBy('show_date')
			->orderBy('show_time') // Ensure times are sorted too
			->get();

		// Group showtimes by date
		$groupedShowtimes = $showtimes->groupBy('show_date');

		return view('movie_info', compact('movie', 'groupedShowtimes'));
	}
}










// public function show($id) {
// 	// $movie = Movie::findOrFail($id); // findOrFail($id): This fetches the movie by movie_id, and if it doesn't exist, it throws a 404 error.
// 	// return view('show', compact('movie'));

// 	$movie = Movie::where('movie_id', $id)->firstOrFail(); // Correctly search by movie_id
// 	return view('show', compact('movie'));
// }