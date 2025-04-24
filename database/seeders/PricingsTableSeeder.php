<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PricingsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		DB::table('pricings')->insert([
			[
				'movie_id' => 1,
				'single_seat_price' => 1550,
				'duo_seat_price' => 2050,
			],
			[
				'movie_id' => 2,
				'single_seat_price' => 1580,
				'duo_seat_price' => 2080,
			],
			[
				'movie_id' => 3,
				'single_seat_price' => 1580,
				'duo_seat_price' => 2080,
			],
			[
				'movie_id' => 4,
				'single_seat_price' => 1580,
				'duo_seat_price' => 2080,
			]
		]);
	}
}
