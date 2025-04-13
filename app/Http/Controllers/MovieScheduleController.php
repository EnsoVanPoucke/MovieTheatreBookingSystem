<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\SeatsTableSeeder;

class MovieScheduleController extends Controller {


	public function scheduleMovie(Request $request) {
		$validated = $request->validate([
			'show_date' => 'required|date',
			'show_time' => 'required|date_format:H:i',
			'screenroom' => 'required|integer',
			// 'poster' => 'required|image|mimes:jpg,png,gif|max:10240',
		]);

		if ($request->hasFile('poster')) {
			$image = $request->file('poster');
			$imageName = $image->getClientOriginalName();
			$destinationPath = public_path('images/movieposters/');
			file_put_contents($destinationPath . $imageName, file_get_contents($image->getRealPath()));
		}

		// Retrieve the form schedule inputs
		$showDate = $validated['show_date'];
		$showTime = $validated['show_time'];
		$screenroomNumber = $validated['screenroom'];

		// You may call the seeder directly or create a custom method to insert data
		(new SeatsTableSeeder())->run($showDate, $showTime, $screenroomNumber);

		return back()->with('success', 'Movie scheduled successfully!');
	}
}
