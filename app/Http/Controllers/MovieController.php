<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Support\Facades\File;

class MovieController extends Controller {

	// get screenings, movies and banners for index page
	public function index() {
		$movies = Movie::select('movies.id', 'movies.title', 'movies.poster_url')
			->join('screenings', 'movies.id', '=', 'screenings.movie_id')
			->whereDate('screenings.screening_date', '>=', now()->toDateString())
			->where('screenings.is_public', 1)
			->groupBy('movies.id', 'movies.title', 'movies.poster_url')
			->selectRaw('MIN(screenings.screening_date) as next_screening_date')
			->orderBy('next_screening_date', 'asc')
			->get();

		$banners = $this->getBanners();

		return view('movies', compact('movies', 'banners'));
	}

	// Get movies for today when filtering
	public function today() {
		$movies = Movie::select('movies.id', 'movies.title', 'movies.poster_url')
			->join('screenings', 'movies.id', '=', 'screenings.movie_id')
			->whereDate('screenings.screening_date', now()->toDateString())
			->where('screenings.is_public', 1)
			->groupBy('movies.id', 'movies.title', 'movies.poster_url')
			->selectRaw('MIN(screenings.screening_date) as next_screening_date')
			->orderBy('next_screening_date', 'asc')
			->get();

		return view('movies', compact('movies'));
	}

	// Get movies for tomorrow when filtering
	public function tomorrow() {
		$movies = \App\Models\Movie::select('movies.id', 'movies.title', 'movies.poster_url')
			->join('screenings', 'movies.id', '=', 'screenings.movie_id')
			->whereDate('screenings.screening_date', now()->addDay()->toDateString())
			->where('screenings.is_public', 1)
			->groupBy('movies.id', 'movies.title', 'movies.poster_url')
			->selectRaw('MIN(screenings.screening_date) as next_screening_date')
			->orderBy('next_screening_date', 'asc')
			->get();

		return view('movies', compact('movies'));
	}

	// get selected movie by id
	public function show($id) {
		// Fetch movie details by id
		$movieData = \App\Models\Movie::findOrFail($id);

		// Fetch associated screenings for this movie (for dropdown menu with dates)
		$movieScreenings = $movieData->screenings()
			->where('is_public', 1)
			->orderBy('screening_date', 'asc')
			->get();

		return view('movie_detail', compact('movieData', 'movieScreenings'));
	}

	// get banners
	private function getBanners() {
		$bannersPath = public_path('images/banners');
		$banners = [];

		if (File::exists($bannersPath)) {
			$files = File::files($bannersPath);
			foreach ($files as $file) {
				$banners[] = 'images/banners/' . $file->getFilename();
			}
		}
		return $banners;
	}
}
