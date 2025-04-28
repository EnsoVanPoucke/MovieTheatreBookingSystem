<?php

namespace App\Http\Controllers;

use App\Models\Seats;
use App\Models\Screen;
use App\Models\Pricing;
use App\Models\Screening;
use App\Enums\SeatStatus;
use App\Enums\GridBlueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller {
	public function show($data) {
		// decode data as object
		$params = json_decode(decrypt($data), false);

		$date = $params->date;
		$time = $params->time;
		$screenNumber = $params->screen_number;
		$movieId = $params->movie_id;
		$movieTitle = $params->movie_title;

		$movieScreeningData = Screening::where([
			['screening_date', '=', $date],
			['screening_time', '=', $time],
			['screen_number', '=', $screenNumber],
			['movie_id', '=', $movieId]
		])->firstOrFail();

		$movieScreeningData['movie_title'] = $movieTitle; // add the movie title to the entire array

		// Store in session
		Session::put('movieScreeningData', $movieScreeningData);

		// get the selected movie pricing
		$moviePricing = Pricing::where('movie_id', $params->movie_id)->first();
		if (!$moviePricing) return redirect()->back()->with('error', 'Pricing details not found.');

		// get the screen data (has_duo_seats)
		$screen = Screen::where('screen_id', $screenNumber)->first();
		if (!$screen) return redirect()->back()->with('error', 'Screen details not found.');

		// Retrieve a count for single seats
		$availableSingleSeats = Seats::where([
			['screening_date', '=', $date],
			['screening_time', '=', $time],
			['screen_number', '=', $screenNumber],
			['seat_status', '=', SeatStatus::AVAILABLE_SINGLE->value]
		])->count();

		// Retrieve a count for duo seats
		$availableDuoSeats = Seats::where([
			['screening_date', '=', $date],
			['screening_time', '=', $time],
			['screen_number', '=', $screenNumber],
			['seat_status', '=', SeatStatus::AVAILABLE_DUO->value]
		])->count();

		$movieTarieven = [
			(object)[
				'seat_label' => 'Single seat - normaal tarief',
				'seat_category' => 'single-normaal',
				'seat_type' => 'singleSeat',
				'price_category' => 'normaal',
				'price' => $moviePricing->single_seat_price
			],
			(object)[
				'seat_label' => 'Single seat - kortingstarief',
				'seat_category' => 'single-korting',
				'seat_type' => 'singleSeat',
				'price_category' => 'korting',
				'price' => ($moviePricing->single_seat_price - 100) // discount -100 is temporarely hard coded
			]
		];

		if ($screen['has_duo_seats']) {
			// Add duo seat pricing if available
			$movieTarieven[] = (object)[
				'seat_label' => 'Duo seat - normaal tarief',
				'seat_category' => 'duo-normaal',
				'seat_type' => 'duoSeat',
				'price_category' => 'normaal',
				'price' => $moviePricing->duo_seat_price
			];
			$movieTarieven[] = (object)[
				'seat_label' => 'Duo seat - kortingstarief',
				'seat_category' => 'duo-korting',
				'seat_type' => 'duoSeat',
				'price_category' => 'korting',
				'price' => ($moviePricing->duo_seat_price - 100) // discount -100 is temporarely hard coded
			];
		}
		return view('book_tickets', compact('movieScreeningData', 'movieTarieven'));
	}

	public function showroom(Request $request) {
		// Handle the booking form data
		$quantities = $request->input('quantity');
		$prices = $request->input('price');
		$types = $request->input('type');
		$pricecategories = $request->input('pricecategory');
		$categories = $request->input('category');

		$seatCollection = [];
		$totalSingleSeats = 0;
		$totalDuoSeats = 0;
		foreach ($quantities as $key => $value) {
			if ($value > 0) {
				match ($types[$key]) {
					'singleSeat' => $totalSingleSeats += $quantities[$key],
					'duoSeat' => $totalDuoSeats += $quantities[$key],
					default => null,
				};
				$seatCollection[] = [
					'category' => $categories[$key],
					'type' => $types[$key],
					'pricecategory' => $pricecategories[$key],
					'quantity' => $value,
					'price' => $prices[$key]
				];
			}
		}

		if ($totalSingleSeats + $totalDuoSeats === 0) return redirect()->back()->with('error', 'You must select at least one seat.');

		$sessionMovieData = Session::get('movieScreeningData');
		if (!$sessionMovieData) return redirect()->back()->with('error', 'Session data not found.');

		$date = $sessionMovieData['screening_date'];
		$time = $sessionMovieData['screening_time'];
		$screenNumber = $sessionMovieData['screen_number'];
		$movieId = $sessionMovieData['movie_id'];
		$title = $sessionMovieData['movie_title'];

		// get the corresponding blueprint from screen number
		$roomGridBlueprint = GridBlueprint::from($screenNumber)?->getBlueprint();
		if (!$roomGridBlueprint) return redirect()->back()->with('error', 'Room blueprint not found.');

		$roomData = Seats::where('screening_date', $date)
			->where('screening_time', $time)
			->where('screen_number', $screenNumber)
			->get();

		$globalSeatNumber = 0;
		$seatNumber = 0;
		foreach ($roomGridBlueprint as $rowIndex => $row) {
			foreach ($row as $colIndex => $seat) {
				if ($seat === SeatStatus::AVAILABLE_SINGLE->value || $seat === SeatStatus::AVAILABLE_DUO->value) {
					$globalSeatNumber++;
					if ($roomGridBlueprint[$rowIndex][$colIndex] !== $roomData[$globalSeatNumber - 1]["seat_status"]) {
						$roomGridBlueprint[$rowIndex][$colIndex] = $roomData[$globalSeatNumber - 1]["seat_status"];
					}
				}
			}
		}

		$booking = (object)[
			'selection_seats' => $seatCollection,
			'totalSingleSeats' => $totalSingleSeats,
			'totalDuoSeats' => $totalDuoSeats,
			'totalSeats' => $totalSingleSeats + $totalDuoSeats,
			'selection_date' => $date,
			'selection_time' => $time,
			'selection_screenroom' => $screenNumber,
			'selection_movieid' => $movieId,
			'selection_title' => $title
		];

		return view('book_seats', compact('booking', 'roomGridBlueprint'));
	}
}
