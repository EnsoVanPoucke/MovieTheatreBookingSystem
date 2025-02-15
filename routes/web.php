<?php

use App\Models\RoomFour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\ScreenroomController;







Route::get('/', function () {
	return view('welcome');
});

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/showtime/{id}', [ShowtimeController::class, 'show'])->name('showtime.details');








// Route om de schermweergave te tonen
Route::get('/screenroom', function () {

	$booking = Session::get('booking'); // get the booking session variable
	if (!$booking) {
		return redirect()->route('home')->with('error', 'Geen boekingsinformatie gevonden.');
	}

	$screenroom = $booking['selection-screenroom'];




	$roomGridBlueprint = Config::get("gridblueprints.blueprints")[$screenroom] ?? null;
	if (!$roomGridBlueprint) {
		return redirect()->route('home')->with('error', 'Geen grid blueprint gevonden voor deze zaal.');
	}




	$roomData = RoomFour::all(); // retrieve all rows from the 'room4' table

	$globalSeatNumber = 0;
	$seatNumber = 0;

	foreach ($roomGridBlueprint as $rowIndex => $row) {
		// dd($roomGridBlueprint);

		foreach ($row as $colIndex => $seat) {
			if ($seat > 9000 && $seat <= 9200) {

				// rowNumberBlocks

			} else if ($seat === 0 || $seat >= 9000) {

				// gridBlocks here

			} else if ($seat === 1 || $seat === 1001) {

				$globalSeatNumber++;

				if ($roomGridBlueprint[$rowIndex][$colIndex] !== $roomData[$globalSeatNumber - 1]["seat_status"]) {
					$roomGridBlueprint[$rowIndex][$colIndex] = $roomData[$globalSeatNumber - 1]["seat_status"];
				}

			} else {

				// special case here

			}
		}
	}
	// return view('screenroom', compact('booking', 'roomData', 'roomGridBlueprint'));
	return view('screenroom', compact('booking', 'roomGridBlueprint'));
})->name('screenroom');





// print('<pre>');
// print_r($roomGridBlueprint);
// print('</pre>');

// exit;



// how do I merge them at the right spot?
// how to create consistency between the gridBlueprints array and the database? (when one of them changes, how does that effect the other one?)







// Route::get('/screenroom', [ScreenroomController::class, 'index']);

Route::post('/screenroom', function (Request $request) {
	// Gegevens opslaan in de sessie
	Session::put('booking', [
		'single-normaal' => $request->input('single-normaal'),
		'single-korting' => $request->input('single-korting'),
		'duo-normaal' => $request->input('duo-normaal'),
		'duo-korting' => $request->input('duo-korting'),
		'total-price' => $request->input('total-price'),

		// Filmgegevens
		'selection-title' => $request->input('selection-title'),
		'selection-screenroom' => $request->input('selection-screenroom'),
		'selection-date' => $request->input('selection-date'),
		'selection-time' => $request->input('selection-time'),
		'selection-movieposter' => $request->input('selection-movieposter')
	]);

	return redirect()->route('screenroom');
})->name('screenroom.store');

Route::get('/tester', function () {
	return view('tester');
});

Route::post('/tester', [TesterController::class, 'store']);






// use App\Models\BookedSeat;

// Route::get('/booked-seats', function () {
//     $bookedSeats = BookedSeat::all(); // Or filter by a room ID, depending on your needs.
//     return response()->json($bookedSeats);
// });