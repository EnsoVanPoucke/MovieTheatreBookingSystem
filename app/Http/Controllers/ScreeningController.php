<?php

namespace App\Http\Controllers;

use Exception;
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
					'screen_number' => $screening->screen_number
				]
			];
		});
		return response()->json($events);
	}

	public function store(Request $request) {
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

	public function delete(Request $request) {
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
}
