<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieScheduleController extends Controller {

	public function addNewMovie(Request $request) {
		$validated = $request->validate([
			'title' => 'required|string|max:100|unique:movies,title',
			'description' => 'required|string',
			'director' => 'required|string|max:255',
			'cast' => 'required|string',
			'genre' => 'required|string|max:255',
			'duration' => 'required|integer',
			'release_date' => 'required|date',
			'poster_url' => 'required|string',
			'trailer_url' => 'required|string',
			'tarief_single_normaal' => 'required|integer',
			'tarief_duo_normaal' => 'required|integer'
		]);

		DB::transaction(function () use ($validated) {
			$movie = Movie::create([
				'title'         => $validated['title'],
				'description'   => $validated['description'],
				'director'      => $validated['director'],
				'cast'          => $validated['cast'],
				'genre'         => $validated['genre'],
				'duration'      => $validated['duration'],
				'release_date'  => $validated['release_date'],
				'poster_url'    => $validated['poster_url'],
				'trailer_url'   => $validated['trailer_url']
			]);

			Pricing::create([
				'movie_id'           => $movie->id,
				'single_seat_price'  => $validated['tarief_single_normaal'],
				'duo_seat_price'     => $validated['tarief_duo_normaal'],
			]);
		});

		return back()->with('success', 'New Movie added successfully!'); //Redirect back to previous page with success session message
	}
}
