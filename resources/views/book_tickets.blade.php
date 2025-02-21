@extends('layouts.app')

@section('content')
<div class="mx-auto w-4/5 bg-gray-300">
	<div class="py-6 px-4">

		<h2 class="text-2xl font-semibold mb-4"><strong>{{ $movieScreeningData->movie->title }}</strong></h2>
		<p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($movieScreeningData->screening_date)->format('l d M Y') }}</p>
		<p><strong>Tijd:</strong> {{ \Carbon\Carbon::parse($movieScreeningData->screening_time)->format('H:i') }}</p>
		<p><strong>Zaal:</strong> {{ $movieScreeningData->screen_number }}</p>
		<p>movie_id: {{ $movieScreeningData->movie_id }}</p>



		@if ($movieTarieven)



		{{--<form id="booking-form" action="{{ route('screenroom.store') }}" method="POST">--}}
		<form>
			@csrf

			<div class="grid grid-cols-4 gap-4">

				<div class="col-span-1">
					<img src="{{ asset('images/movieposters/' . $movieScreeningData->movie->poster_url) }}"
						alt="{{ $movieScreeningData->movie->title }} Image">
				</div>


				<div class="col-span-3 flex-auto">

					@foreach($movieTarieven as $item)

					<div class="flex border-t border-gray-900/20 py-4 justify-between">

						<!-- Label -->
						<div class="tickets-list-item-label flex items-center">
							<h1 class="text-2xl font-semibold text-gray-700/100">{{ $item['label'] }}</h1>
						</div>

						<!-- Price -->
						<div class="price-item-container flex items-center gap-5">
							<h2 class="text-xl font-semibold text-gray-700/100">
								{{ number_format($item['prijs'] / 100, 2, ',', '.') }} &euro;
							</h2>

							<!-- Showtime date select options -->
							<div class="relative">
								<select id="{{$item['ticket-type']}}"
									name="{{$item['ticket-type']}}"
									class="border border-gray-900/20 w-24 appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
									@for ($i = 0; $i <= 10; $i++)
										<option value="{{ $i }}">{{ $i }}</option>
										@endfor
								</select>

								<!-- Icon positioned at the far right -->
								<svg class="pointer-events-none absolute top-1/2 right-2 transform -translate-y-1/2 size-4 text-gray-500"
									viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
									<path fill-rule="evenodd"
										d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</div>

					</div>

					@endforeach






					<!-- TOTAAL BEDRAG - begin -->
					<div class="grid grid-cols-5 border-t border-gray-900/20 py-4 bg-blue-600">
						<div class="tickets-list-item-label col-span-3 flex items-center">
							<!-- <h1 class="text-2xl font-semibold text-gray-700/100">Totaal</h1> -->
						</div>
						<div class=" price-item-container col-span-1 flex items-center">
							<h2 id="total-price" name="total-price" class="text-2xl font-semibold text-white">0,00 &euro;</h2>
						</div>
						<!-- # -->
						<div class="col-span-1 flex items-center">

							<!-- Verborgen velden voor filmgegevens -->
							{{--
							<input type="hidden" name="selection-title" value="{{ $screening->movie->title }}">
							<input type="hidden" name="selection-screenroom" value="{{ $screening->screen_number }}">
							<input type="hidden" name="selection-date" value="{{ $screening->screening_date }}">
							<input type="hidden" name="selection-time" value="{{ $screening->screening_time }}">
							<input type="hidden" name="selection-movieposter" value="{{ $screening->movie->poster_url }}">

							<input type="hidden" name="total-price" id="total-price-hidden">
							--}}

							<div class="col-span-1 flex items-center">
								<button type="submit"
									class="bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-600">
									Verder
								</button>
							</div>

						</div>
					</div>
					<!-- TOTAAL BEDRAG - end -->



				</div>
			</div>
		</form>















		<script>
			document.addEventListener("DOMContentLoaded", function() {

				let total = 0;
				let prices = {};

				// Pass the entire $movieTarieven array to JavaScript as a JSON object
				const movieTarieven = @json($movieTarieven);

				// Populate the prices object with the correct values from the movieTarieven array
				movieTarieven.forEach(item => {
					prices[item['ticket-type']] = item['prijs'];
				});


				function calculateTotal() {
					total = 0;

					// Loop through each select element dynamically
					document.querySelectorAll("select").forEach(select => {
						const selectId = select.id;
						const aantal = parseInt(select.value) || 0; // Get the value from the select, default to 0 if empty

						// Determine ticket type by matching the selectId with the keys in prices
						let ticketType = Object.keys(prices).find(key => selectId.includes(key)) || '';

						// console.log("ticketType:", ticketType, "- aantal:", aantal);

						// If ticket type found, add to total
						if (ticketType) total += aantal * prices[ticketType];
					});

					// Update total price
					document.getElementById("total-price").textContent = (total / 100).toFixed(2).replace('.', ',') + " €";
				}

				// Event listener for each select input to trigger total calculation when the aantal changes
				document.querySelectorAll("select").forEach(select => {
					select.addEventListener("change", calculateTotal);
				});

				// Initial total calculation on page load
				calculateTotal();
			});
		</script>






		@else
		<p>Pricing not available</p>
		@endif

	</div>
</div>



@endsection