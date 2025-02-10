<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScreenroomController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/screenroom', [ScreenroomController::class, 'index']);






















// use App\Models\BookedSeat;

// Route::get('/booked-seats', function () {
//     $bookedSeats = BookedSeat::all(); // Or filter by a room ID, depending on your needs.
//     return response()->json($bookedSeats);
// });