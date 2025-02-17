<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsTableSeeder extends Seeder {

	public function run($showDate, $showTime, $screenroomNumber) {

		$roomLayout = config("gridblueprints.blueprints.{$screenroomNumber}");
		$seatNumber = 1;

		foreach ($roomLayout as $row) {
			$rowId = $row[0] - 9000; // Get the row_id (first value of the row)

			for ($i = 1; $i < count($row); $i++) {
				$seatStatus = $row[$i];

				if ($seatStatus == 1 || $seatStatus == 1001) {
					DB::table('seats')->insert([
						'show_date' => $showDate,
						'show_time' => $showTime,
						'screenroom_number' => $screenroomNumber,
						'seat_number' => $seatNumber,
						'row_number' => $rowId,
						'seat_status' => $seatStatus
					]);
					$seatNumber++;
				}
			}
		}
	}
}

// php artisan migrate --path=/database/migrations/SeatsTableSeeder.php
