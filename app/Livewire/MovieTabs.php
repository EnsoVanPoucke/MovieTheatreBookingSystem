<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovieTabs extends Component {
	public $movies = [];  // Movies array
	public $filter = 'allefilms';  // Default filter

	// Fetch movies based on the current filter
	public function render() {
		$this->movies = $this->getMoviesByFilter($this->filter);
		return view('livewire.movie-tabs');  // Livewire view
	}

	public function getMoviesByFilter($filter) {
		$query = DB::table('movies as m')
			->join('screenings as s', 'm.id', '=', 's.movie_id')
			->where('s.is_public', 1);

		if ($filter == 'vandaag') {
			$query->whereDate('s.screening_date', Carbon::today());
		} elseif ($filter == 'morgen') {
			$query->whereDate('s.screening_date', Carbon::tomorrow());
		} else {
			$query->where('s.screening_date', '>=', Carbon::today());
		}

		$movies = $query
			->select('m.id', 'm.title', 'm.poster_url', DB::raw('MIN(s.screening_date) AS next_screening_date'))
			->groupBy('m.id', 'm.title', 'm.poster_url')
			->orderBy('next_screening_date', 'ASC')
			->get();

		return $movies;
	}

	public function setFilter($filter) {
		$this->filter = $filter;
	}
}
