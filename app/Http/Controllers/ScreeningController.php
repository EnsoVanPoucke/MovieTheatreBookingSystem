<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Database\Seeders\SeatsTableSeeder;

class ScreeningController extends Controller {

	public function getEvents() {
		$colorMap = [
			1 => '#3498db', // blue
			2 => '#1abc9c', // teal
			3 => '#e67e22', // orange
			4 => '#9b59b6', // purple
			5 => '#e74c3c', // red
		];

		$screenings = Screening::with('movie')->get();

		$events = $screenings->map(function ($screening) use ($colorMap) {
			$start = $screening->screening_date . 'T' . $screening->screening_time;
			$end = \Carbon\Carbon::parse($start)
				->addMinutes($screening->movie->duration)
				->setTimezone('Europe/Brussels')
				->toIso8601String();
			return [
				'title' => $screening->movie->title,
				'start' => $start,
				'end' => $end,
				'resourceId' => (string) $screening->screen_number,
				'color' => $colorMap[$screening->screen_number] ?? '#95a5a6',
				'extendedProps' => [
					'movie_id' => $screening->movie->id,
					'screen_number' => $screening->screen_number,
					'is_public' => $screening->is_public
				]
			];
		});
		return response()->json($events);
	}

	public function createEvent(Request $request) {
		$validatedData = $request->validate([
			'movie_id' => 'required|exists:movies,id',
			'screen_number' => 'required|integer|min:1|max:4',
			'start' => 'required|date',
			'end' => 'required|date|after:start',
			'is_public' => 'nullable|boolean'
		]);

		$start = \Carbon\Carbon::parse($request->start);
		$end = \Carbon\Carbon::parse($request->end);

		DB::transaction(function () use ($validatedData, $start) {
			// Create the screening
			Screening::create([
				'movie_id' => $validatedData['movie_id'],
				'screening_date' => $start->format('Y-m-d'),
				'screening_time' => $start->format('H:i:s'),
				'screen_number' => $validatedData['screen_number'],
				'is_public' => $validatedData['is_public'] ?? 0
			]);

			$screeningDate = $start->format('Y-m-d');
			$screeningTime = $start->format('H:i:s');
			$screenNumber = $validatedData['screen_number'];

			// Run the seat seeder to create rows per seat for this screening
			(new SeatsTableSeeder())->run($screeningDate, $screeningTime, $screenNumber);
		});

		return response()->json(['message' => 'Screening created successfully']);
	}

	public function deleteEvent(Request $request) {
		try {
			// Get the composite key values from the request
			$screeningDate = $request->screening_date;
			$screeningTime = $request->screening_time;
			$screenNumber = $request->screen_number;

			DB::transaction(function () use ($screeningDate, $screeningTime, $screenNumber) {
				// Delete seats related to the screening
				DB::table('seats')
					->where('screening_date', $screeningDate)
					->where('screening_time', $screeningTime)
					->where('screen_number', $screenNumber)
					->delete();

				// Delete the screening
				Screening::where('screening_date', $screeningDate)
					->where('screening_time', $screeningTime)
					->where('screen_number', $screenNumber)
					->delete();
			});

			return response()->json(['success' => true]);
		} catch (Exception $e) {
			return response()->json(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	public function updateEvent(Request $request) {
		// Validate the request data
		$validatedData = $request->validate([
			'movie_id' => 'required|exists:movies,id',
			'screen_number' => 'required|integer|min:1|max:4',
			'screening_date' => 'required|date',
			'screening_time' => 'required|date_format:H:i:s',
			'is_public' => 'nullable|boolean'
		]);

		// Start a transaction to ensure both the screening and the seats are updated atomically
		try {
			DB::transaction(function () use ($validatedData) {
				// Find the screening to update
				$screening = Screening::where('screening_date', $validatedData['screening_date'])
					->where('screening_time', $validatedData['screening_time'])
					->where('screen_number', $validatedData['screen_number'])
					->firstOrFail(); // Throws an exception if not found

				// Update the screening details
				$screening->update([
					'movie_id' => $validatedData['movie_id'],
					'screening_date' => $validatedData['screening_date'],
					'screening_time' => $validatedData['screening_time'],
					'screen_number' => $validatedData['screen_number'],
					'is_public' => $validatedData['is_public'] ?? 0
				]);

				// Update the seats related to this screening
				DB::table('seats')
					->where('screening_date', $validatedData['screening_date'])
					->where('screening_time', $validatedData['screening_time'])
					->where('screen_number', $validatedData['screen_number'])
					->update([
						'screening_date' => $validatedData['screening_date'],
						'screening_time' => $validatedData['screening_time'],
						'screen_number' => $validatedData['screen_number']
					]);
			});

			// If everything goes well, return a success message
			return response()->json(['success' => true, 'message' => 'Screening and seats updated successfully']);
		} catch (Exception $e) {
			// Catch any exception and return an error message
			return response()->json(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	// autocomplete search function
	public function searchMovieTitle(Request $request) {
		$query = $request->input('query'); // Movie title query
		// $movies = Movie::where('title', 'LIKE', '%' . $query . '%')->limit(5)->get(); // Fetch up to 5 titles
		$movies = Movie::where('title', 'LIKE', '%' . $query . '%')->get(['id', 'title']);
		return response()->json($movies);
	}
}
