<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('movies')->insert([
			[
				'title' => 'The Dark Knight',
				'description' => 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham.',
				'director' => 'Christopher Nolan',
				'cast' => 'Christian Bale, Heath Ledger, Aaron Eckhart',
				'genre' => 'Action, Crime, Drama',
				'duration' => 152,
				'release_date' => '2008-07-18',
				'poster_url' => 'the_dark_knight.jpg',
				'trailer_url' => '#',
				'created_at' => now()
			],
			[
				'title' => 'Vaiana 2',
				'description' => 'After receiving an unexpected call from her wayfinding ancestors, Moana must journey to the far seas of Oceania and into dangerous, long-lost waters for an adventure unlike anything she\'s ever faced.',
				'director' => 'David G. Derrick Jr., Jason Hand, Dana Ledoux Miller',
				'cast' => 'Auli\'i Cravalho, Dwayne Johnson, Hualalai Chung',
				'genre' => 'Animation',
				'duration' => 160,
				'release_date' => '2024-11-27',
				'poster_url' => 'vaiana_2.jpg',
				'trailer_url' => '#',
				'created_at' => now()
			]
		]);
	}
}
