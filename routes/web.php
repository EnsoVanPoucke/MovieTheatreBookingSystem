<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\ScreenroomController;

Route::get('/', function () {
	return view('welcome');
});

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/showtime/{id}', [ShowtimeController::class, 'show'])->name('showtime.details');


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

// Route om de schermweergave te tonen
Route::get('/screenroom', function () {
	$booking = Session::get('booking');

	if (!$booking) {
		return redirect()->route('home')->with('error', 'Geen boekingsinformatie gevonden.');
	}

	return view('screenroom', compact('booking'));
})->name('screenroom');














// use App\Models\BookedSeat;

// Route::get('/booked-seats', function () {
//     $bookedSeats = BookedSeat::all(); // Or filter by a room ID, depending on your needs.
//     return response()->json($bookedSeats);
// });