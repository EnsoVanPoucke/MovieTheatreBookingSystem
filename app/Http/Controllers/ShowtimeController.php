<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller {
	public function show($id) {
		$showtime = Showtime::with(['screenroom', 'movie'])->findOrFail($id);  // Added 'movie' relationship
		return view('details', compact('showtime'));  // Pass 'showtime' to the view
	}
}







// public function show($id) {
// 	$showtime = Showtime::with('screenroom')->findOrFail($id);
// 	return view('details', compact('showtime'));  // Updated this line
// }
