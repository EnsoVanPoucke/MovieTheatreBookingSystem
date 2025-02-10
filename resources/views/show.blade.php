@extends('layouts.app')

@section('content')

<div class="container my-4">

	<div class="container-fluid bg-light mb-4 p-4">
		<div class="row">
			<div class="col-4">
				<select class="form-select" id="date-select">
					@foreach($dates as $date)
					<option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}</option>
					@endforeach
				</select>
			</div>

			<div class="col">
				<div id="showtime-buttons">
					@foreach($showtimes as $showtime)
					<button class="btn btn-primary showtime-btn"
						data-date="{{ \Carbon\Carbon::parse($showtime->showtime)->toDateString() }}">
						{{ \Carbon\Carbon::parse($showtime->showtime)->format('H:i') }}
					</button>
					@endforeach
				</div>
			</div>

		</div>
	</div>

	<div class="container-fluid bg-light mb-4 p-4">
		<div class="row row-cols-2 g-4">
			<div class="col-lg-4">
				<img class="img-fluid"
					src="{{ asset('images/movieposters/' . $movie->image_url) }}"
					alt="{{ $movie->title }} Image">
			</div>
			<div class="col-lg-8">
				<h3 class="mb-3">{{ $movie->title }}</h3>

				<h5 class="text-body-primary lh-1">Storyline</h5>
				<p class="text-body-secondary lh-1">{{ $movie->description }}</p>

				<h5 class="text-body-primary lh-1">Director</h5>
				<p class="text-body-secondary lh-1">{{ $movie->director }}</p>

				<h5 class="text-body-primary lh-1">Cast</h5>
				<p class="text-body-secondary lh-1">{{ $movie->cast }}</p>

				<h5 class="text-body-primary lh-1">Genre</h5>
				<p class="text-body-secondary lh-1">{{ $movie->genre }}</p>

				<h5 class="text-body-primary lh-1">Duration</h5>
				<p class="text-body-secondary lh-1">{{ $movie->duration }}</p>


			</div>
		</div>
	</div>
</div>

@endsection