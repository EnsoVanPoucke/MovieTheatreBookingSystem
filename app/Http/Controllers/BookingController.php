<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Pricing;
use Illuminate\Http\Request;

class BookingController extends Controller {


	public function show($data) {

		$params = json_decode(decrypt($data), true);

		$movieScreeningData = Screening::where([
			['screening_date', '=', $params['date']],
			['screening_time', '=', $params['time']],
			['screen_number', '=', $params['screen']],
			['movie_id', '=', $params['movie_id']]
		])->firstOrFail();


		$moviePricing = Pricing::where('movie_id', $params['movie_id'])->first();

		$movieTarieven = [
			[
				'label' => 'Single seat - normaal tarief',
				'ticket-type' => 'single-normaal',
				'prijs' => $moviePricing->single_seat_price
			],
			[
				'label' => 'Single seat - kortingstarief',
				'ticket-type' => 'single-korting',
				'prijs' => ($moviePricing->single_seat_price - 100)
			]
		];

		// Add duo seat pricing if available
		if (!is_null($moviePricing->duo_seat_price)) {
			$movieTarieven[] = [
				'label' => 'Duo seat - normaal tarief',
				'ticket-type' => 'duo-normaal',
				'prijs' => $moviePricing->duo_seat_price
			];
			$movieTarieven[] = [
				'label' => 'Duo seat - kortingstarief',
				'ticket-type' => 'duo-korting',
				'prijs' => ($moviePricing->duo_seat_price - 100)
			];
		}

		// dd($movieTarieven);

		return view('book_tickets', compact('movieScreeningData', 'movieTarieven'));
	}
}








	// Fetch the pricing based on screening details
	// $movieTarieven = Pricing::where([
	// 	['screening_date', '=', $params['date']],
	// 	['screening_time', '=', $params['time']],
	// 	['screen_number', '=', $params['screen']]
	// ])->get();




// dd($screening->toArray());



// public function show($date, $time, $screen) {
// 	// Find screening using the composite key
// 	$screening = Screening::where([
// 		['screening_date', '=', $date],
// 		['screening_time', '=', $time],
// 		['screen_number', '=', $screen]
// 	])->firstOrFail();

// 	return view('book_tickets', compact('screening'));
// }