@props(['value'])

<a href="{{ route('movies.show', $movie->id) }}" class="group">
	<div class="bg-white shadow-md">
		<div class=" w-full relative overflow-hidden">
			<img src="{{ asset('images/movieposters/' . $movie->poster_url) }}"
				alt="{{ $movie->title }} Image"
				class="w-full h-auto object-cover group-hover:opacity-75"
				loading="lazy">
		</div>
		<div class="min-h-40 p-3">
			<h3 class="text-base text-gray-800">{{ $movie->title }}</h3>
		</div>
	</div>
</a>