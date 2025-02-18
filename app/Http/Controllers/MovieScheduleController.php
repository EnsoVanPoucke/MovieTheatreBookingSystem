<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Database\Seeders\SeatsTableSeeder;

class MovieScheduleController extends Controller {

	public function scheduleMovie(Request $request) {
		// Validate the form inputs
		$validated = $request->validate([

			// information data
			'title' => 'required|title',
			'description' => 'required|description',
			'director' => 'required|director',
			'cast' => 'required|cast',
			'genre' => 'required|genre',
			'duration' => 'required|duration',
			'release_date' => 'required|release_date',
			'image_url' => 'required|image_url',

			// tickets data
			'tarief_single_normaal' => 'required|tarief_single_normaal',
			'tarief_single_korting' => 'required|tarief_single_korting',
			'tarief_duo_normaal' => 'required|tarief_duo_normaal',
			'tarief_duo_korting' => 'required|tarief_duo_korting',

			// schedule data
			'show_date' => 'required|date',
			'show_time' => 'required|date_format:H:i',
			'screenroom' => 'required|integer',
		]);

		// Retrieve the form information inputs
		$title = $validated['title'];
		$description = $validated['description'];
		$director = $validated['director'];
		$cast = $validated['cast'];
		$genre = $validated['genre'];
		$duration = $validated['duration'];
		$releaseDate = $validated['release_date'];
		$imgUrl = $validated['image_url'];


		// Retrieve the form tickets inputs
		$tariefSingleNormaal = $validated['tarief_single_normaal'];
		$tariefSingleKorting = $validated['tarief_single_korting'];
		$tariefDuoNormaal = $validated['tarief_duo_normaal'];
		$tariefDuoKorting = $validated['tarief_duo_korting'];

		// Retrieve the form schedule inputs
		$showDate = $validated['show_date'];
		$showTime = $validated['show_time'];
		$screenroomNumber = $validated['screenroom'];

		// You may call the seeder directly or create a custom method to insert data
		(new SeatsTableSeeder())->run($showDate, $showTime, $screenroomNumber);



		// insert other data into 'movies' AND showtimes



		return back()->with('success', 'Movie scheduled successfully!');
	}

	public function deleteMovie(Request $request) {
		// Validate the form inputs
		$validated = $request->validate([

			// // information data
			// 'title' => 'required|title',
			// 'description' => 'required|description',
			// 'director' => 'required|director',
			// 'cast' => 'required|cast',
			// 'genre' => 'required|genre',
			// 'duration' => 'required|duration',
			// 'release_date' => 'required|release_date',
			// 'image_url' => 'required|image_url',

			// // tickets data
			// 'tarief_single_normaal' => 'required|tarief_single_normaal',
			// 'tarief_single_korting' => 'required|tarief_single_korting',
			// 'tarief_duo_normaal' => 'required|tarief_duo_normaal',
			// 'tarief_duo_korting' => 'required|tarief_duo_korting',

			// schedule data
			'show_date' => 'required|date',
			'show_time' => 'required|date_format:H:i',
			'screenroom' => 'required|integer',
		]);

		// // Retrieve the form information inputs
		// $title = $validated['title'];
		// $description = $validated['description'];
		// $director = $validated['director'];
		// $cast = $validated['cast'];
		// $genre = $validated['genre'];
		// $duration = $validated['duration'];
		// $releaseDate = $validated['release_date'];
		// $imgUrl = $validated['image_url'];


		// // Retrieve the form tickets inputs
		// $tariefSingleNormaal = $validated['tarief_single_normaal'];
		// $tariefSingleKorting = $validated['tarief_single_korting'];
		// $tariefDuoNormaal = $validated['tarief_duo_normaal'];
		// $tariefDuoKorting = $validated['tarief_duo_korting'];

		// Retrieve the form schedule inputs
		$showDate = $validated['show_date'];
		$showTime = $validated['show_time'];
		$screenroomNumber = $validated['screenroom'];

		// You may call the seeder directly or create a custom method to insert data
		// (new SeatsTableSeeder())->run($showDate, $showTime, $screenroomNumber);



		// insert other data into 'movies' AND showtimes

		return back()->with('success', 'Movie deleted successfully!');
	}
}
