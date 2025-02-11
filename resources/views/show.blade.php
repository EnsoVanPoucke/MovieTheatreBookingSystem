@extends('layouts.app')

@section('content')

<div class="container my-4">
	
	

	<div class="container">
		<div class="flex">
			<div class="w-1/4">
				<select class="form-select" id="date-select">
					@foreach($dates as $date)
					<option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}</option>
					@endforeach
				</select>
			</div>

			<div class="w-full">
				<div id="showtime-buttons" class="flex flex-wrap gap-2">
					@foreach($showtimes as $showtime)
					<button class="btn btn-primary showtime-btn bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600"
						data-date="{{ \Carbon\Carbon::parse($showtime->showtime)->toDateString() }}">
						{{ \Carbon\Carbon::parse($showtime->showtime)->format('H:i') }}
					</button>
					@endforeach
				</div>
			</div>

		</div>
	</div>

	<div class="bg-light mb-4 p-4">
		<div class="grid grid-cols-2 gap-4">
			<div class="col-span-1">
				<img class="w-full object-cover"
					src="{{ asset('images/movieposters/' . $movie->image_url) }}"
					alt="{{ $movie->title }} Image">
			</div>
			<div class="col-span-1">
				<h3 class="mb-3 text-2xl font-semibold">{{ $movie->title }}</h3>

				<h5 class="text-primary leading-tight">Storyline</h5>
				<p class="text-secondary leading-tight">{{ $movie->description }}</p>

				<h5 class="text-primary leading-tight">Director</h5>
				<p class="text-secondary leading-tight">{{ $movie->director }}</p>

				<h5 class="text-primary leading-tight">Cast</h5>
				<p class="text-secondary leading-tight">{{ $movie->cast }}</p>

				<h5 class="text-primary leading-tight">Genre</h5>
				<p class="text-secondary leading-tight">{{ $movie->genre }}</p>

				<h5 class="text-primary leading-tight">Duration</h5>
				<p class="text-secondary leading-tight">{{ $movie->duration }}</p>
			</div>
		</div>
	</div>
</div>

@endsection