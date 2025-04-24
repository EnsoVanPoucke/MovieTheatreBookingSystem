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
			],
			[
				'title' => 'Interstellar',
				'description' => 'When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans.',
				'director' => 'Christopher Nolan',
				'cast' => 'Matthew McConaughey, Anne Hathaway, Jessica Chastain',
				'genre' => 'Adventure Epic, Drama',
				'duration' => 169,
				'release_date' => '2014-11-05',
				'poster_url' => 'interstellar.jpg',
				'trailer_url' => '#',
				'created_at' => now()
			],
			[
				'title' => 'Inglourious Basterds',
				'description' => 'In Nazi-occupied France during World War II, a plan to assassinate Nazi leaders by a group of Jewish U.S. soldiers coincides with a theatre owner\'s vengeful plans for the same.',
				'director' => 'Quentin Tarantino',
				'cast' => 'Brad Pitt, Diane Kruger, Christoph Waltz, Michael Fassbender, Mélanie Laurent',
				'genre' => 'Dark comedy, Drama, War',
				'duration' => 153,
				'release_date' => '2009-08-19',
				'poster_url' => 'inglourious_basterds.jpg',
				'trailer_url' => '#',
				'created_at' => now()
			]
		]);
	}
}
