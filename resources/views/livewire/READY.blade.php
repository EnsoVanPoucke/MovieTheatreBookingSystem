<div>

	<!-- buttons -->
	<div class="bg-gray-200">
		<div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8 flex gap-3">
			<button
				class="{{ $filter === 'all' ? 'bg-orange-600 text-white' : 'bg-white text-orange-600' }} 
                text-sm font-semibold border-2 border-orange-600 py-2 px-4 hover:bg-orange-600 hover:text-white flex items-center gap-2"
				wire:click="setFilter('all')">
				@if($filter === 'all')
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
				</svg>
				@endif
				ALL FILMS
			</button>
			<button
				class="{{ $filter === 'today' ? 'bg-orange-600 text-white' : 'bg-white text-orange-600' }} 
                text-sm font-semibold border-2 border-orange-600 py-2 px-4 hover:bg-orange-600 hover:text-white flex items-center gap-2"
				wire:click="setFilter('today')">
				@if($filter === 'today')
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
				</svg>
				@endif
				VANDAAG
			</button>
			<button
				class="{{ $filter === 'tomorrow' ? 'bg-orange-600 text-white' : 'bg-white text-orange-600' }} 
                text-sm font-semibold border-2 border-orange-600 py-2 px-4 hover:bg-orange-600 hover:text-white flex items-center gap-2"
				wire:click="setFilter('tomorrow')">
				@if($filter === 'tomorrow')
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
				</svg>
				@endif
				MORGEN
			</button>
		</div>
	</div>



	<!-- Movie list -->
	<div class="mx-auto max-w-5xl py-8 sm:px-6 lg:px-8">
		<div class="grid sm:grid-cols-2 grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-6">
			@foreach($movies as $movie)
			<a href="{{ route('movies.show', $movie->id) }}" class="group">
				<div class="bg-white shadow-md">
					<div class=" w-full relative overflow-hidden">
						<img src="{{ asset('images/movieposters/' . $movie->poster_url) }}"
							alt="{{ $movie->title }} Image"
							class="w-full h-auto object-cover group-hover:opacity-75"
							loading="lazy">
					</div>
					<div class="min-h-40 p-3 flex flex-col justify-between">
						<h3 class="font-medium text-base text-gray-800">{{ $movie->title }}</h3>
						<div class="my-2 px-2 flex flex-wrap items-center justify-evenly mt-auto">
							@php
							$imageIcons = ['IMAX.png', 'LASER.png', '3D.png']; // The image options
							shuffle($imageIcons); // Shuffle the array to randomize order
							$imaxCount = rand(2, 3); // Randomize between 2 and 3 images
							@endphp

							@for ($i = 0; $i < $imaxCount; $i++)
								<img src="{{ asset('images/icons/' . $imageIcons[$i]) }}" alt="{{ $imageIcons[$i] }} icon"
								class="object-scale-down w-[44px]">
								@endfor
						</div>
					</div>
				</div>
			</a>
			@endforeach
		</div>
	</div>

</div>