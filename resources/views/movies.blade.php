@extends('layouts.app')

@section('content')

<div class="bg-white">
	<div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
		<div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 xl:gap-x-8">
			@foreach($movies as $movie)
			<a href="{{ route('movies.show', $movie->movie_id) }}" class="group">
				<div class="w-full relative overflow-hidden rounded-lg">
					<img src="{{ asset('images/movieposters/' . $movie->image_url) }}" alt="{{ $movie->title }} Image" class="w-full h-auto object-cover group-hover:opacity-75">
				</div>
				<h3 class="mt-4 text-base text-gray-700">{{ $movie->title }}</h3>
			</a>
			@endforeach
		</div>
	</div>
</div>

@endsection









<!-- <li>
	<em>{{ $movie->genre }}</em><br>
	<p>{{ $movie->description }}</p>
	<p><strong>Price:</strong> ${{ $movie->price }}</p>
	<p><strong>Release Date:</strong> {{ $movie->releaseDate }}</p>
	<p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
	<p><strong>Director:</strong> {{ $movie->director }}</p>
	<p><strong>Cast:</strong> {{ $movie->cast }}</p>
	<a href="{{ $movie->trailerUrl }}" target="_blank">Watch Trailer</a>
</li> -->