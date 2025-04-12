@extends('layouts.layoutMovie')

@section('content')

<div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-8">

	<div class="bg-white mb-5 py-6 px-4">

		<!-- Screening date options -->
		<div class="grid grid-cols-4 gap-4">
			<div class="col-span-1">
				<div class="grid grid-cols-1 col-span-2">
					<select id="screening-select"
						name="screening"
						class="text-base py-2 col-start-1 row-start-1 w-full appearance-none bg-white pr-8 pl-4 text-base text-gray-800 outline-1 -outline-offset-1 outline-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm">
						<option value="" selected>Selecteer datum</option>
						@foreach($movieScreenings->unique('screening_date') as $option)
						<option value="{{ $option->screening_date }}">
							{{ \Carbon\Carbon::parse($option->screening_date)->format('j F Y') }}
						</option>
						@endforeach
					</select>
					<svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-5" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
						<path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
					</svg>
				</div>
			</div>

			<!-- Screening time buttons -->
			<div class="col-span-3">
				<div id="screening-buttons" class="flex flex-wrap gap-4">

					@foreach($movieScreenings->groupBy('screening_date') as $key => $value)

					<div class="screening-group gap-4 sm:text-sm" data-date="{{ $key }}" style="display: none;">

						@foreach($value as $button)

						<a href="{{ route('TicketSelection', ['data' => encrypt(json_encode([
							'date' => $button->screening_date,
    						'time' => $button->screening_time,
    						'screen_number' => $button->screen_number,
    						'movie_id' => $button->movie_id,
    						'movie_title' => $movieData->title
						]))]) }}"
							class="bg-blue-500 font-semibold text-white py-2 px-4 rounded-md hover:bg-blue-600">
							{{ \Carbon\Carbon::parse($button->screening_time)->format('H:i') }} - Zaal {{ $button->screen_number }}
						</a>


						@endforeach
					</div>
					@endforeach
				</div>
			</div>
		</div>

	</div>





	<!-- Movie Details -->
	<div class="bg-light py-6 px-4">
		<div class="grid grid-cols-4 gap-4">
			<div class="col-span-1">
				<img class="some-image-class" src="{{ asset('images/movieposters/' . $movieData->poster_url) }}"
					alt="{{ $movieData->title }} Image">
			</div>

			<div class="col-span-3">
				<h3 class="mb-3 text-2xl font-semibold">{{ $movieData->title }}</h3>
				<h5 class="font-semibold">Storyline</h5>
				<p class="mb-3">{{ $movieData->description }}</p>
				<h5 class="font-semibold">Director</h5>
				<p class="mb-3">{{ $movieData->director }}</p>
				<h5 class="font-semibold">Cast</h5>
				<p class="mb-3">{{ $movieData->cast }}</p>
				<h5 class="font-semibold">Genre</h5>
				<p class="mb-3">{{ $movieData->genre }}</p>
				<h5 class="font-semibold">Duration</h5>
				<p class="mb-3">{{ $movieData->duration }}</p>
			</div>
		</div>
	</div>

</div>



<script>
	document.addEventListener("DOMContentLoaded", function() {
		const screeningSelect = document.getElementById("screening-select");
		const screeningGroups = document.querySelectorAll(".screening-group");

		screeningSelect.addEventListener("change", function() {
			const selectedDate = this.value;

			// Hide all screening buttons
			screeningGroups.forEach(group => {
				group.style.display = "none";
			});

			// Show only the buttons for the selected date
			const activeGroup = document.querySelector(`.screening-group[data-date="${selectedDate}"]`);
			if (activeGroup) {
				activeGroup.style.display = "flex";
			}
		});
	});
</script>

@endsection