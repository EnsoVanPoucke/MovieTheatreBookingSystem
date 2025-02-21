<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\Request;

class ScreeningController extends Controller {
	// public function show($id) {
	// 	$screening = Screening::with(['screen_number', 'movie'])->findOrFail($id);  // Added 'movie' relationship
	// 	return view('details', compact('screening'));  // Pass 'screening' to the view
	// }
}







// public function show($id) {
// 	$showtime = Showtime::with('screenroom')->findOrFail($id);
// 	return view('details', compact('showtime'));  // Updated this line
// }
