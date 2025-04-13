<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsTableSeeder extends Seeder {

	public function run($screenDate, $screenTime, $screenNumber) {

		$roomLayout = config("gridblueprints.blueprints.{$screenNumber}");

		// keep track of numbers while looping
		$globalSeatNumber = 1;
		$seatNumber = 1;

		foreach ($roomLayout as $row) {
			$rowId = $row[0] - 9000; // Get the row_id (first value of the row)

			for ($i = 1; $i < count($row); $i++) {
				$seatStatus = $row[$i];

				if ($seatStatus == 1 || $seatStatus == 1001) {
					DB::table('seats')->insert([
						'screening_date' => $screenDate,
						'screening_time' => $screenTime,
						'screen_number' => $screenNumber,
						'global_seat_number' => $globalSeatNumber,
						'seat_number' => $seatNumber,
						'row_number' => $rowId,
						'seat_status' => $seatStatus
					]);
					$globalSeatNumber++;
					$seatNumber++;
				}
			}
			$seatNumber = 1;
		}
	}
}
