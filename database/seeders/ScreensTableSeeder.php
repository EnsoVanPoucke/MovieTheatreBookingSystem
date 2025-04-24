<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScreensTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		DB::table('screens')->insert([
			[
				'name' => 'Zaal 1',
				'description' => 'An extra large screen room for big blockbuster movies or business events.',
				'capacity' => 349,
				'screen_type' => 'IMAX',
				'sound_system' => 'Dolby Atmos',
				'resolution' => '4K',
				'has_single_seats' => 1,
				'has_duo_seats' => 1
			],
			[
				'name' => 'Zaal 2',
				'description' => 'An extra large screen room for big blockbuster movies or business events.',
				'capacity' => 250,
				'screen_type' => 'IMAX',
				'sound_system' => 'Dolby Atmos',
				'resolution' => '4K',
				'has_single_seats' => 1,
				'has_duo_seats' => 1
			],
			[
				'name' => 'Zaal 3',
				'description' => 'A medium cosy screen room for medium events.',
				'capacity' => 200,
				'screen_type' => 'IMAX',
				'sound_system' => 'Dolby Atmos',
				'resolution' => '4K',
				'has_single_seats' => 1,
				'has_duo_seats' => 0
			],
			[
				'name' => 'Zaal 4',
				'description' => 'A small screen room for small events',
				'capacity' => 150,
				'screen_type' => 'IMAX',
				'sound_system' => 'Dolby Atmos',
				'resolution' => '4K',
				'has_single_seats' => 1,
				'has_duo_seats' => 0
			]
		]);
	}
}
