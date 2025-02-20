<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use Illuminate\Http\Request;

class BookingController extends Controller {

	public function show($date, $time, $screen) {
		// Find screening using the composite key
		$screening = Screening::where([
			['screening_date', '=', $date],
			['screening_time', '=', $time],
			['screen_number', '=', $screen]
		])->firstOrFail();

		// dd($screening->toArray());

		return view('book_tickets', compact('screening'));
	}
}
