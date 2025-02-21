<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller {

	public function index() {
		$movies = collect(DB::select(
			"SELECT m.id, 
			m.title, 
			m.poster_url,
			MIN(s.screening_date) AS next_screening_date
			FROM movies m
			JOIN screenings s ON m.id = s.movie_id
			WHERE s.screening_date >= CURDATE() 
			AND s.is_public = 1
			GROUP BY m.id, m.title, m.poster_url
			ORDER BY next_screening_date ASC"
		));

		return view('movies', compact('movies'));
	}

	public function show($id) {
		// Fetch movie details by id
		$movieData = DB::selectOne(
			"SELECT * FROM movies
			WHERE id = :id",
			['id' => $id]
		);

		// Fetch associated screenings for this movie (for dropdown menu with dates)
		$movieScreenings = collect(DB::select(
			"SELECT * FROM screenings 
        	WHERE movie_id = :id
        	AND is_public = 1 
        	ORDER BY screening_date ASC",
			['id' => $id]
		));

		return view('movie_detail', compact('movieData', 'movieScreenings'));
	}










	// // get screenings
	// public function index() {
	// 	$movies = Movie::whereHas('screenings', function ($query) {
	// 		$query->whereDate('screening_date', '>=', Carbon::today())
	// 			->where('is_public', true);
	// 	})
	// 		->with(['screenings' => function ($query) {
	// 			$query->orderBy('screening_date'); // Order screenings properly
	// 		}])
	// 		->get();

	// 	return view('movies', compact('movies'));
	// }

	// // get selected movie by id.
	// public function show(Movie $movie) {
	// 	$screenings = $movie->screenings()
	// 		->where('is_public', true)
	// 		->orderBy('screening_date')
	// 		->get();

	// 	return view('movie_detail', compact('movie', 'screenings'));
	// }
}



// dd($movie->toArray());



























// public function index() {
// 	$movies = Movie::all();
// 	return view('movies', compact('movies'));
// }

// public function show($id) {
// 	$movie = Movie::where('id', $id)->firstOrFail();

// 	$screenings = $movie->screenings()
// 		->where('screening_date', '>=', Carbon::now()) // Get only future screenings
// 		->orderBy('screening_date')
// 		->orderBy('screening_time')
// 		->get();

// 	// Group screenings by date
// 	$groupedScreenings = $screenings->groupBy('screening_date');

// 	return view('movie_info', compact('movie', 'groupedScreenings'));
// }