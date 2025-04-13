<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller {
	public function bookSeats(Request $request) {
		try {
			$validated = $request->validate([
				'date' => 'required|date',
				'time' => 'required',
				'screenroom' => 'required',
				'title' => 'required',
				'selectedSingleSeatDetails' => 'array',
				'selectedDuoSeatDetails' => 'array'
			]);

			// If both arrays are empty, return early to avoid unnecessary DB transactions
			if (empty($validated['selectedSingleSeatDetails']) && empty($validated['selectedDuoSeatDetails'])) {
				return response()->json([
					'success' => false,
					'message' => 'No seats selected for booking.'
				], 400);
			}

			DB::transaction(function () use ($validated) {
				// Update seat_status for single seats
				if (!empty($validated['selectedSingleSeatDetails'])) {

					$singleSeatNumbers = array_column($validated['selectedSingleSeatDetails'], 'global_seat_number');

					$updatedSingle = Seat::where('screening_date', $validated['date'])
						->where('screening_time', $validated['time'])
						->where('screen_number', $validated['screenroom'])
						->whereIn('global_seat_number', $singleSeatNumbers)
						->update(['seat_status' => 3]);

					if ($updatedSingle === 0) {
						throw new \Exception('Failed to update single seats.');
					}
				}

				// Update seat_status for duo seats
				if (!empty($validated['selectedDuoSeatDetails'])) {

					$duoSeatNumbers = array_column($validated['selectedDuoSeatDetails'], 'global_seat_number');

					$updatedDuo = Seat::where('screening_date', $validated['date'])
						->where('screening_time', $validated['time'])
						->where('screen_number', $validated['screenroom'])
						->whereIn('global_seat_number', $duoSeatNumbers)
						->update(['seat_status' => 1003]);

					if ($updatedDuo === 0) {
						throw new \Exception('Failed to update duo seats.');
					}
				}
			});

			// when updating database is successfull...
			// create an array for each ticket here...
			$bookedTickets = [];

			// Process single seats
			if (!empty($validated['selectedSingleSeatDetails'])) {
				foreach ($validated['selectedSingleSeatDetails'] as $seat) {
					$bookedTickets[] = [
						'date' => $validated['date'],
						'time' => substr($validated['time'], 0, 5), // HH:MM
						'screen_number' => $validated['screenroom'],
						'title' => $validated['title'],
						'seat_number' => $seat['seat_number'],
						'seat_row' => $seat['row_number'],
						'seat_type' => 'single'
					];
				}
			}

			// Process duo seats
			if (!empty($validated['selectedDuoSeatDetails'])) {
				foreach ($validated['selectedDuoSeatDetails'] as $seat) {
					$bookedTickets[] = [
						'date' => $validated['date'],
						'time' => substr($validated['time'], 0, 5),
						'screen_number' => $validated['screenroom'],
						'title' => $validated['title'],
						'seat_number' => $seat['seat_number'],
						'seat_row' => $seat['row_number'],
						'seat_type' => 'duo'
					];
				}
			}

			// return ajax response
			return response()->json([
				'success' => true,
				'message' => 'Seats booked successfully.',
				'tickets' => $bookedTickets
			]);
		} catch (\Throwable $e) {
			Log::error('Seat booking failed:', ['error' => $e->getMessage()]);

			return response()->json([
				'error' => 'Something went wrong. Check logs for details.'
			], 500);
		}
	}
}
