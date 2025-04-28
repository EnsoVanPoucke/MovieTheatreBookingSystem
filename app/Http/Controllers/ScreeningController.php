<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Database\Seeders\SeatsTableSeeder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ScreeningController extends Controller {

	// get all admin calendar events
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
				->addMinutes($screening->break_duration)
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
					'break_duration' => $screening->break_duration,
					'is_public' => $screening->is_public
				]
			];
		});
		return response()->json($events);
	}

	// create admin calendar event
	public function createEvent(Request $request) {
		$validatedData = $request->validate([
			'start' => 'required|date',
			'end' => 'required|date|after:start',
			'movie_id' => 'required|exists:movies,id',
			'screen_number' => 'required|integer|min:1|max:4',
			'break_duration' => 'required|integer',
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
				'break_duration' => $validatedData['break_duration'],
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

	// update admin calendar event
	public function updateEvent(Request $request) {

		// Validate the request data first
		$validatedData = $request->validate([
			'screening_date' => 'required|date',
			'screening_time' => 'required',
			'screen_number' => 'required',
			'is_public' => 'nullable|boolean',
		]);

		// Get the composite key values from the validated data
		$screeningDate = $validatedData['screening_date'];
		$screeningTime = $validatedData['screening_time'];
		$screenNumber = $validatedData['screen_number'];
		$isPublic = $validatedData['is_public'] ?? 0;

		try {
			// Retrieve the screening using composite keys
			$screening = Screening::where('screening_date', $screeningDate)
				->where('screening_time', $screeningTime)
				->where('screen_number', $screenNumber)
				->update(['is_public' => $isPublic]);

			return response()->json([
				'success' => true,
				'message' => 'Event updated successfully'
			]);
		} catch (ModelNotFoundException $e) {
			// If not found, return 404
			return response()->json([
				'success' => false,
				'message' => 'Event not found.'
			], 404);
		} catch (Exception $e) {
			// Any other exception
			return response()->json([
				'success' => false,
				'message' => 'An error occurred: ' . $e->getMessage()
			], 500);
		}
	}

	// delete admin calendar event
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

	// autocomplete search function for admin calendar
	public function searchMovieTitle(Request $request) {
		$query = $request->input('query'); // Movie title query
		// $movies = Movie::where('title', 'LIKE', '%' . $query . '%')->limit(5)->get(); // Fetch up to 5 titles
		$movies = Movie::where('title', 'LIKE', '%' . $query . '%')->get(['id', 'title']);
		return response()->json($movies);
	}
}
