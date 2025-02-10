@extends('layouts.app')

@section('content')
<h1>Movies</h1>

<div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 g-4">
	@foreach($movies as $movie)
	<div class="col">
		<div class="card shadow-sm h-100">
			<img src="{{ asset('images/movieposters/' . $movie->image_url) }}" alt="{{ $movie->title }} Image" class="card-img-top">
			<div class="card-body">
				<h5 class="card-title">{{ $movie->title }}</h5>
				<a href="{{ route('movies.show', $movie->movie_id) }}" class="stretched-link"></a>
			</div>
		</div>
	</div>
	@endforeach
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