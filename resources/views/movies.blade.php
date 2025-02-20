@extends('layouts.app')

@section('content')


<div class="bg-gray-200 p-8 mt-8">
	<div class="mx-auto w-3/4">
		<div class="flex">
			<a href="#"
				class="bg-white text-orange-600 text-sm font-semibold border-2 border-orange-600 py-2 px-4 hover:bg-orange-600 hover:text-white">
				ALLE FILMS
			</a>
			<a href="#"
				class="bg-white text-orange-600 text-sm font-semibold border-2 border-orange-600 py-2 px-4 hover:bg-orange-600 hover:text-white mx-4">
				VANDAAG
			</a>
			<a href="#"
				class="bg-white text-orange-600 text-sm font-semibold border-2 border-orange-600 py-2 px-4 hover:bg-orange-600 hover:text-white">
				MORGEN
			</a>
		</div>
	</div>
</div>






<div>
	<div class="mx-auto w-3/4 max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
		<div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 xl:gap-x-8">
			@foreach($movies as $movie)
			<a href="{{ route('movies.show', $movie->id) }}" class="group">
				<div class="bg-white shadow-md rounded-lg">
					<div class=" w-full relative overflow-hidden rounded-t-lg">
						<img src="{{ asset('images/movieposters/' . $movie->poster_url) }}"
							alt="{{ $movie->title }} Image"
							class="w-full h-auto object-cover group-hover:opacity-75"
							loading="lazy">
					</div>
					<div class="p-5">
						<h3 class="text-base text-gray-800">{{ $movie->title }}</h3>
					</div>
				</div>
			</a>
			@endforeach
		</div>
	</div>
</div>

@endsection