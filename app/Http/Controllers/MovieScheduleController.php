<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Database\Seeders\SeatsTableSeeder;

class MovieScheduleController extends Controller {

	public function scheduleMovie(Request $request) {
		// Validate the form inputs
		$validated = $request->validate([
			'show_date' => 'required|date',
			'show_time' => 'required|date_format:H:i',
			'screenroom' => 'required|integer',
		]);

		// Retrieve the form inputs
		$showDate = $validated['show_date'];
		$showTime = $validated['show_time'];
		$screenroomNumber = $validated['screenroom'];

		// You may call the seeder directly or create a custom method to insert data
		(new SeatsTableSeeder())->run($showDate, $showTime, $screenroomNumber);

		return back()->with('success', 'Movie scheduled successfully!');
	}
}
