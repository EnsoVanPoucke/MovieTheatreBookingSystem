<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieScheduleController extends Controller {

	public function addNewMovie(Request $request) {
		$validated = $request->validate(
			[
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
			],
			[
				'title.required' => 'Title required.',
				'title.unique' => 'Title already exists.',
				'description.required' => 'Description required.',
				'director.required' => 'Director required.',
				'cast.required' => 'Cast required.',
				'genre.required' => 'Genre required.',
				'duration.required' => 'Duration required.',
				'duration.integer' => 'must be number (minutes).',
				'release_date.required' => 'Release date required.',
				'release_date.date' => 'must be valid date.',
				'poster_url.required' => 'Poster url required.',
				'trailer_url.required' => 'Trailer url required.',
				'tarief_single_normaal.required' => 'Tarief required.',
				'tarief_single_normaal.integer' => 'must be cents.',
				'tarief_duo_normaal.required' => 'Tarief required.',
				'tarief_duo_normaal.integer' => 'must be cents.',
			]
		);

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

	public function deleteMovie(Request $request) {
		$validated = $request->validate(
			['title' => 'required|string|exists:movies,title'],
			['title.required' => 'Title required.']
		);

		$deleted = Movie::where('title', $validated['title'])->delete();

		if ($deleted) {
			return back()->with('success', $validated['title'] . '" deleted successfully.');
		}

		return back()->with('error', $validated['title'] . '" could not be deleted.');
	}
}
