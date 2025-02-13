@extends('layouts.app')

@section('content')
<div class="container my-4">
	<div class="bg-light py-6 px-4">

		<h2 class="text-2xl font-semibold mb-4">Showtime Details</h2>
		<h3 class="mt-4 text-xl font-semibold">{{ $showtime->movie->title }}</h3>
		<p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($showtime->show_date)->format('l, d M Y') }}</p>
		<p><strong>Tijd:</strong> {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }}</p>
		<p><strong>Zaal:</strong> {{ $showtime->screenroom->screenroom_id }}</p>

		<form id="booking-form" action="{{ route('screenroom.store') }}" method="POST">
			@csrf


			<div class="grid grid-cols-4 gap-4">


				<div class="col-span-1">
					<img src="{{ asset('images/movieposters/' . $showtime->movie->image_url) }}"
						alt="{{ $showtime->movie->title }} Image"
						class="mt-4">
				</div>


				<div class="col-span-3">


					<!-- SINGLE SEAT NORMAAL TARIEF - begin -->
					<div class="grid grid-cols-5 border-t border-gray-900/20 py-4 mt-4">
						<div class=" tickets-list-item-label col-span-3 flex items-center">
							<h1 class="text-2xl font-semibold text-gray-700/100">Single seat - Normaal tarief</h1>
						</div>
						<div class=" price-item-container col-span-1 flex items-center">
							<h2 class="text-xl font-semibold text-gray-700/100">{{ number_format($showtime->movie->tarief_single_normaal / 100, 2, ',', '.') }} &euro;</h2>
						</div>
						<!-- Showtime date select options -->
						<div class="col-span-1">
							<div class="grid col-span-2">
								<select id="single-normaal"
									name="single-normaal"
									class="border border-gray-900/20 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="10">10</option>
								</select>
								<svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
									viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
									<path fill-rule="evenodd"
										d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</div>
					</div>
					<!-- SINGLE SEAT NORMAAL TARIEF - end -->



					<!-- SINGLE SEAT KORTINGSTARIEF - begin -->
					<div class="grid grid-cols-5 border-t border-gray-900/20 py-4">
						<div class="tickets-list-item-label col-span-3 flex items-center">
							<h1 class="text-2xl font-semibold text-gray-700/100">Single seat - Kortingstarief</h1>
						</div>
						<div class=" price-item-container col-span-1 flex items-center">
							<h2 class="text-xl font-semibold text-gray-700/100">{{ number_format($showtime->movie->tarief_single_korting / 100, 2, ',', '.') }} &euro;</h2>
						</div>
						<!-- Showtime date select options -->
						<div class="col-span-1">
							<div class="grid col-span-2">
								<select id="single-korting"
									name="single-korting"
									class="border border-gray-900/20 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="10">10</option>
								</select>
								<svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
									viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
									<path fill-rule="evenodd"
										d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</div>
					</div>
					<!-- SINGLE SEAT KORTINGSTARIEF - end -->



					<!-- DUO SEAT NORMAAL TARIEF - begin -->
					<div class="grid grid-cols-5 border-t border-gray-900/20 py-4">
						<div class="tickets-list-item-label col-span-3 flex items-center">
							<h1 class="text-2xl font-semibold text-gray-700/100">Duo seat - Normaal tarief</h1>
						</div>
						<div class=" price-item-container col-span-1 flex items-center">
							<h2 class="text-xl font-semibold text-gray-700/100">{{ number_format($showtime->movie->tarief_duo_normaal / 100, 2, ',', '.') }} &euro;</h2>
						</div>
						<!-- Showtime date select options -->
						<div class="col-span-1">
							<div class="grid col-span-2">
								<select id="duo-normaal"
									name="duo-normaal"
									class="border border-gray-900/20 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="10">10</option>
								</select>
								<svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
									viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
									<path fill-rule="evenodd"
										d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</div>
					</div>
					<!-- DUO SEAT NORMAAL TARIEF - end -->



					<!-- DUO SEAT KORTINGSTARIEF - begin -->
					<div class="grid grid-cols-5 border-t border-gray-900/20 py-4">
						<div class="tickets-list-item-label col-span-3 flex items-center">
							<h1 class="text-2xl font-semibold text-gray-700/100">Duo seat - Kortingstarief</h1>
						</div>
						<div class=" price-item-container col-span-1 flex items-center">
							<h2 class="text-xl font-semibold text-gray-700/100">{{ number_format($showtime->movie->tarief_duo_korting / 100, 2, ',', '.') }} &euro;</h2>
						</div>
						<!-- Showtime date select options -->
						<div class="col-span-1">
							<div class="grid col-span-2">
								<select id="duo-korting"
									name="duo-korting"
									class="border border-gray-900/20 col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="10">10</option>
								</select>
								<svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
									viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
									<path fill-rule="evenodd"
										d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</div>
					</div>
					<!-- DUO SEAT KORTINGSTARIEF - end -->



					<!-- TOTAAL BEDRAG - begin -->
					<div class="grid grid-cols-5 border-t border-gray-900/20 py-4 bg-blue-600">
						<div class="tickets-list-item-label col-span-3 flex items-center">
							<!-- <h1 class="text-2xl font-semibold text-gray-700/100">Totaal</h1> -->
						</div>
						<div class=" price-item-container col-span-1 flex items-center">
							<h2 id="total-price" name="total-price" class="text-xl font-semibold text-white">0,00 &euro;</h2>
						</div>
						<!-- # -->
						<div class="col-span-1 flex items-center">

							<!-- Verborgen velden voor filmgegevens -->
							<input type="hidden" name="selection-title" value="{{ $showtime->movie->title }}">
							<input type="hidden" name="selection-screenroom" value="{{ $showtime->screenroom->screenroom_id }}">
							<input type="hidden" name="selection-date" value="{{ $showtime->show_date }}">
							<input type="hidden" name="selection-time" value="{{ $showtime->show_time }}">
							<input type="hidden" name="selection-movieposter" value="{{ $showtime->movie->image_url }}">

							<input type="hidden" name="total-price" id="total-price-hidden">

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
	</div>
</div>


<script>
	document.addEventListener("DOMContentLoaded", function() {
		function calculateTotal() {
			let total = 0;

			// Haal de ticketprijzen op
			const priceSingleNormaal = parseInt("{{ $showtime->movie->tarief_single_normaal }}");
			const priceSingleKorting = parseInt("{{ $showtime->movie->tarief_single_korting }}");
			const priceDuoNormaal = parseInt("{{ $showtime->movie->tarief_duo_normaal }}");
			const priceDuoKorting = parseInt("{{ $showtime->movie->tarief_duo_korting }}");

			// Haal de geselecteerde aantallen op
			const qtySingleNormaal = parseInt(document.getElementById("single-normaal").value);
			const qtySingleKorting = parseInt(document.getElementById("single-korting").value);
			const qtyDuoNormaal = parseInt(document.getElementById("duo-normaal").value);
			const qtyDuoKorting = parseInt(document.getElementById("duo-korting").value);

			// Bereken het totaalbedrag
			total += qtySingleNormaal * priceSingleNormaal;
			total += qtySingleKorting * priceSingleKorting;
			total += qtyDuoNormaal * priceDuoNormaal;
			total += qtyDuoKorting * priceDuoKorting;

			// Toon het totaalbedrag
			document.getElementById("total-price").textContent = (total / 100).toFixed(2).replace('.', ',') + " €";
			// Zet het totaalbedrag in de verborgen input
			document.getElementById("total-price-hidden").value = total;
		}

		// Event listeners toevoegen aan de select-velden
		document.querySelectorAll("select").forEach(select => {
			select.addEventListener("change", calculateTotal);
		});

		// Bereken het totaalbedrag bij pagina-load
		calculateTotal();
	});
</script>

@endsection