<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movies/details/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/Booking/TicketSelection/{date}/{time}/{screen}', [BookingController::class, 'show'])->name('TicketSelection');


// In your routes/web.php or controller

// Route::post('/Booking/TicketSelection', function (Request $request) {
// 	// Store the values in the session
// 	session([
// 		'screening_date' => $request->input('screening_date'),
// 		'screening_time' => $request->input('screening_time'),
// 		'screen_number' => $request->input('screen_number')
// 	]);

// 	// Redirect to the ticket selection page
// 	return view('book_tickets');
// })->name('TicketSelection');

// Route::get('/movies', [MovieController::class, 'index']);
// use App\Models\Seats;
// use Illuminate\Http\Request;
// use App\Http\Controllers\MovieScheduleController;
// use App\Http\Controllers\TesterController;
// use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Config;
// use App\Http\Controllers\ScreenroomController;
// use App\Http\Controllers\ShowtimeController;