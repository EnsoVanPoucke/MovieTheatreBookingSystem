@extends('layouts.app')

@section('content')

<div class="container mx-auto w-3/4">



	<div class="bg-white mb-5 py-6 px-4">

		<!-- Screening date options -->
		<div class="grid grid-cols-4 gap-4">
			<div class="col-span-1">
				<div class="grid col-span-2">
					<select id="screening-select"
						name="screening"
						class="border border-gray-900/20 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
						<option value="" selected>Select a date</option>
						@foreach($screenings->unique('screening_date') as $screening)
						<option value="{{ $screening->screening_date }}">
							{{ \Carbon\Carbon::parse($screening->screening_date)->format('l j F Y') }}
						</option>
						@endforeach
					</select>
					<svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
						viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
						<path fill-rule="evenodd"
							d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
							clip-rule="evenodd" />
					</svg>
				</div>
			</div>



			<!-- Screening time buttons -->
			<div class="col-span-3">
				<div id="screening-buttons" class="flex flex-wrap gap-4">
					@foreach($screenings->groupBy('screening_date') as $date => $dateScreenings)
					<div class="screening-group gap-4" data-date="{{ $date }}" style="display: none;">
						@foreach($dateScreenings as $screening)



						<a href="{{ route('TicketSelection', ['date' => $screening->screening_date, 'time' => $screening->screening_time, 'screen' => $screening->screen_number]) }}"
							class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
							{{ \Carbon\Carbon::parse($screening->screening_time)->format('H:i')}} - Zaal {{ $screening->screen_number }}
						</a>



						{{--
						<button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
							{{ \Carbon\Carbon::parse($screening->screening_time)->format('H:i')}} - Zaal {{ $screening->screen_number }}
						<input type="hidden" name="screening_date" value="{{ $screening->screening_date }}">
						<input type="hidden" name="screening_time" value="{{ $screening->screening_time }}">
						<input type="hidden" name="screen_number" value="{{ $screening->screen_number }}">
						</button>
						--}}



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
				<img class="some-image-class" src="{{ asset('images/movieposters/' . $movie->poster_url) }}"
					alt="{{ $movie->title }} Image">
			</div>

			<div class="col-span-3">
				<h3 class="mb-3 text-2xl font-semibold">{{ $movie->title }}</h3>
				<h5 class="mb-3 font-semibold">Storyline</h5>
				<p class="mb-3">{{ $movie->description }}</p>
				<h5 class="mb-3 font-semibold">Director</h5>
				<p class="mb-3">{{ $movie->director }}</p>
				<h5 class="mb-3 font-semibold">Cast</h5>
				<p class="mb-3">{{ $movie->cast }}</p>
				<h5 class="mb-3 font-semibold">Genre</h5>
				<p class="mb-3">{{ $movie->genre }}</p>
				<h5 class="mb-3 font-semibold">Duration</h5>
				<p class="mb-3">{{ $movie->duration }}</p>
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