<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\MovieScheduleController;

Route::view('/', 'welcome');
Route::view('/admin/calendar', 'admin_calendar');
Route::view('/movies', 'movies');
Route::view('/admin/add-new-movie', 'add_new_movie');
Route::view('/admin/delete-movie', 'delete_movie');



Route::get('/admin/calendar/events', [ScreeningController::class, 'getEvents']);
Route::post('/admin/calendar/create', [ScreeningController::class, 'createEvent']);
Route::patch('/admin/calendar/update', [ScreeningController::class, 'updateEvent']); // changed put to patch
Route::delete('/admin/calendar/delete', [ScreeningController::class, 'deleteEvent']);

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', function () {
	session(['url.intended' => url()->previous()]);
	return view('auth.login');
})->name('login');

Route::get('/movies/details/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/Booking/TicketSelection/{data}', [BookingController::class, 'show'])->name('TicketSelection');
Route::get('/Booking/SeatSelection/{data}', [BookingController::class, 'showroom'])->name('SeatSelection');
Route::post('/booking/showroom', [BookingController::class, 'showroom'])->name('booking.showroom');
Route::post('/book-seats', [SeatController::class, 'bookSeats']);



Route::get('/booking/confirmation', function (Request $request) {
	$bookingData = json_decode($request->query('data'), true);
	return view('confirmation', compact('bookingData'));
});

Route::get('/checkout', function (Request $request) {
	return view('checkout', [
		'selectedTickets' => $request->selectedTickets
	]);
})->name('checkout');


Route::post('/add-new-movie', [MovieScheduleController::class, 'addNewMovie'])->name('add.movie');
Route::post('/delete-movie', [MovieScheduleController::class, 'deleteMovie'])->name('delete.movie');


// autocomplete movie title search
Route::get('/search-movie-title', [ScreeningController::class, 'searchMovieTitle']);

require __DIR__ . '/auth.php';
