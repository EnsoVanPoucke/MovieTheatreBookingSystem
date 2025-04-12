<?php

namespace App\Http\Controllers;

use App\Models\Seats;
use App\Models\Screen;
use App\Models\Pricing;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller {
	public function show($data) {

		$params = json_decode(decrypt($data), true);

		$date = $params['date'];
		$time = $params['time'];
		$screenNumber = $params['screen_number'];
		$movieId = $params['movie_id'];
		$movieTitle = $params['movie_title'];
		// moviePosterUrl = $params['movie_title'].jpg (slug the title name here...)

		$movieScreeningData = Screening::where([
			['screening_date', '=', $date],
			['screening_time', '=', $time],
			['screen_number', '=', $screenNumber],
			['movie_id', '=', $movieId]
		])->firstOrFail();

		$movieScreeningDataArray = $movieScreeningData->toArray(); // Convert to array before modifying
		$movieScreeningData['movie_title'] = $movieTitle; // add the movie title to the entire array

		// Store in session
		Session::put('movieScreeningData', $movieScreeningData);

		// get the selected movie pricing
		$moviePricing = Pricing::where('movie_id', $params['movie_id'])->first();
		// if $moviePricing is null -> do not continue...

		// get the screen data (has_duo_seats)
		$screen = Screen::where('screen_id', $screenNumber)->first();
		// if $screen is null -> do not continue...

		// Retrieve a count for single seats
		$availableSingleSeats = Seats::where([
			['screening_date', '=', $date],
			['screening_time', '=', $time],
			['screen_number', '=', $screenNumber],
			['seat_status', '=', 1]
		])->count();

		// Retrieve a count for duo seats
		$availableDuoSeats = Seats::where([
			['screening_date', '=', $date],
			['screening_time', '=', $time],
			['screen_number', '=', $screenNumber],
			['seat_status', '=', 1001]
		])->count();

		$movieTarieven = [
			[
				'seat-label' => 'Single seat - normaal tarief',
				'seat-category' => 'single-normaal',
				'seat-type' => 'singleSeat',
				'price-category' => 'normaal',
				'price' => $moviePricing->single_seat_price
			],
			[
				'seat-label' => 'Single seat - kortingstarief',
				'seat-category' => 'single-korting',
				'seat-type' => 'singleSeat',
				'price-category' => 'korting',
				'price' => ($moviePricing->single_seat_price - 100) // -100 is for testing
			]
		];

		if ($screen['has_duo_seats']) {
			// Add duo seat pricing if available
			$movieTarieven[] = [
				'seat-label' => 'Duo seat - normaal tarief',
				'seat-category' => 'duo-normaal',
				'seat-type' => 'duoSeat',
				'price-category' => 'normaal',
				'price' => $moviePricing->duo_seat_price
			];
			$movieTarieven[] = [
				'seat-label' => 'Duo seat - kortingstarief',
				'seat-category' => 'duo-korting',
				'seat-type' => 'duoSeat',
				'price-category' => 'korting',
				'price' => ($moviePricing->duo_seat_price - 100) // -100 is for testing
			];
		}
		return view('book_tickets', compact('movieScreeningData', 'movieTarieven'));
	}

	public function showroom(Request $request) {
		// Handle the booking form data
		$quantities = $request->input('quantity');  			// ...
		$prices = $request->input('price'); 					// ...
		$types = $request->input('type');						// ...
		$pricecategories = $request->input('pricecategory');	// ...
		$categories = $request->input('category');				// ...

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

		// if user selected any seats at all, redirect back...
		if ($totalSingleSeats + $totalDuoSeats === 0) return redirect()->back()->with('error', 'You must select at least one seat.');

		$sessionMovieData = Session::get('movieScreeningData');
		if (!$sessionMovieData) return; // do not continue

		$date = $sessionMovieData['screening_date'];
		$time = $sessionMovieData['screening_time'];
		$screenNumber = $sessionMovieData['screen_number'];
		$movieId = $sessionMovieData['movie_id'];
		$title = $sessionMovieData['movie_title'];

		$roomGridBlueprint = Config::get("gridblueprints.blueprints")[$screenNumber] ?? null;
		if (!$roomGridBlueprint) return; // do not continue

		// instead retrieve all rows from the seats table WHERE primary key = date, time, screenroom, seatnumber
		$roomData = Seats::where('screening_date', $date)
			->where('screening_time', $time)
			->where('screen_number', $screenNumber)
			->get();

		$globalSeatNumber = 0;
		$seatNumber = 0;
		foreach ($roomGridBlueprint as $rowIndex => $row) {
			foreach ($row as $colIndex => $seat) {
				if ($seat === 1 || $seat === 1001) {
					$globalSeatNumber++;
					if ($roomGridBlueprint[$rowIndex][$colIndex] !== $roomData[$globalSeatNumber - 1]["seat_status"]) {
						$roomGridBlueprint[$rowIndex][$colIndex] = $roomData[$globalSeatNumber - 1]["seat_status"];
					}
				}
			}
		}

		$booking = [
			// complete seats data collection
			'selection-seats' => $seatCollection,

			// seats quantity
			'totalSingleSeats' => $totalSingleSeats,
			'totalDuoSeats' => $totalDuoSeats,
			'totalSeats' => $totalSingleSeats + $totalDuoSeats,

			// movie data
			'selection-date' => $date,
			'selection-time' => $time,
			'selection-screenroom' => $screenNumber,
			'selection-movieid' => $movieId,
			'selection-title' => $title
		];

		return view('book_seats', compact('booking', 'roomGridBlueprint'));
	}
}
