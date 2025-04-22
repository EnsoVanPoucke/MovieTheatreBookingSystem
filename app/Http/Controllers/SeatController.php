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

			/**
			 * DB TRANSACTION to update seat satus
			 */
			DB::transaction(function () use ($validated) {
				// Update seat_status for single seats
				if (!empty($validated['selectedSingleSeatDetails'])) {
					$this->updateSeatStatus(
						$validated['date'],
						$validated['time'],
						$validated['screenroom'],
						array_column($validated['selectedSingleSeatDetails'], 'global_seat_number'),
						3 // Status for single seats
					);
				}

				// Update seat_status for duo seats
				if (!empty($validated['selectedDuoSeatDetails'])) {
					$this->updateSeatStatus(
						$validated['date'],
						$validated['time'],
						$validated['screenroom'],
						array_column($validated['selectedDuoSeatDetails'], 'global_seat_number'),
						1003 // Status for duo seats
					);
				}
			});

			/**
			 * Create booked tickets
			 */
			$bookedTickets = [];

			if (!empty($validated['selectedSingleSeatDetails'])) {
				$bookedTickets = array_merge(
					$bookedTickets,
					$this->formatBookedSeats($validated['selectedSingleSeatDetails'], $validated, 'single')
				);
			}

			if (!empty($validated['selectedDuoSeatDetails'])) {
				$bookedTickets = array_merge(
					$bookedTickets,
					$this->formatBookedSeats($validated['selectedDuoSeatDetails'], $validated, 'duo')
				);
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

	// helper function to book seats
	private function formatBookedSeats(array $seats, array $baseData, string $type): array {
		return array_map(function ($seat) use ($baseData, $type) {
			return [
				'date' => $baseData['date'],
				'time' => substr($baseData['time'], 0, 5), // HH:MM
				'screen_number' => $baseData['screenroom'],
				'title' => $baseData['title'],
				'seat_number' => $seat['seat_number'],
				'seat_row' => $seat['row_number'],
				'seat_type' => $type,
			];
		}, $seats);
	}

	// helper function to update status
	private function updateSeatStatus(string $date, string $time, string $screenNumber, array $seatNumbers, int $status) {
		$updated = Seat::where('screening_date', $date)
			->where('screening_time', $time)
			->where('screen_number', $screenNumber)
			->whereIn('global_seat_number', $seatNumbers)
			->update(['seat_status' => $status]);

		if ($updated === 0) {
			throw new \Exception("Failed to update seats with status {$status}.");
		}
	}
}
