@extends('layouts.layoutBooking')

@section('content')

<div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-8">
	<div>

		<h2 class="text-2xl font-semibold mb-4"><strong>{{ $movieScreeningData->movie->title }}</strong></h2>
		<p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($movieScreeningData->screening_date)->format('l d M Y') }}</p>
		<p><strong>Tijd:</strong> {{ \Carbon\Carbon::parse($movieScreeningData->screening_time)->format('H:i') }}</p>
		<p><strong>Zaal:</strong> {{ $movieScreeningData->screen_number }}</p>
		<p>movie_id: {{ $movieScreeningData->movie_id }}</p>

		@if ($movieTarieven)

		{{--<form id="booking-form" action="{{ route('screenroom.store') }}" method="POST">--}}
		<form>
			@csrf

			<div class="grid grid-cols-4 gap-4"
				x-data="{ selectedTickets: {}, totalPrice: 0 }"
				x-on:update-total.window="selectedTickets[$event.detail.index] = $event.detail.total;
                totalPrice = Object.values(selectedTickets).reduce((sum, val) => sum + val, 0);">

				<div class="col-span-1">
					<img src="{{ asset('images/movieposters/' . $movieScreeningData->movie->poster_url) }}"
						alt="{{ $movieScreeningData->movie->title }} Image">
				</div>

				<!-- livewire select options -->
				<div class="col-span-3 flex-auto">



					<div id="select-container">
						@foreach($movieTarieven as $index => $tarief)
						<div class="flex border-t border-gray-900/20 py-4 justify-between">
							<!-- Seat Label -->
							<div class="tickets-list-item-label flex items-center">
								<h1 class="text-2xl font-semibold text-gray-700">{{ $tarief['seat-label'] }}</h1>
							</div>

							<div class="flex gap-4">
								<!-- Seat Price -->
								<div class="tickets-price-item flex items-center">
									<h1 class="text-2xl font-semibold text-blue-900">
										{{ number_format($tarief['seat-price'] / 100, 2, ',', '.') }} &euro;
									</h1>
								</div>
								<!-- Seat Quantity Selection -->
								<div class="price-item-container flex items-center gap-5">
									<div class="relative">
										<x-form-select name="quantity[{{ $index }}]" price="{{ $tarief['seat-price'] }}" />
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>



				</div>

				<!-- blade button -->
				<div class="col-span-4 flex items-center justify-end bg-blue-600 py-4">
					<div class="flex items-center">
						<h2 id="total-price" class="text-2xl font-semibold text-white" x-text="totalPrice.toFixed(2).replace('.', ',') + ' €'"></h2>
					</div>
					<div class="flex items-center mx-4">
						<x-continue-button>Verder</x-continue-button>
					</div>
				</div>

			</div>

		</form>

		@else
		<p>Pricing not available</p>
		@endif

	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const selectContainer = document.getElementById('select-container');
		const totalPriceText = document.getElementById('total-price');

		selectContainer.addEventListener('change', function(event) {
			if (event.target.tagName.toLowerCase() === 'select') {
				const allSelects = selectContainer.querySelectorAll('select');
				const selectedValues = {};
				let totalPrice = 0;

				allSelects.forEach(function(select) {
					const selectedValue = select.value;
					const pricePerSeat = select.querySelector(`option[value="${selectedValue}"]`).getAttribute('data-price');
					selectedValues[select.name] = {
						quantity: selectedValue,
						price: pricePerSeat
					};
					totalPrice += pricePerSeat * selectedValue;
				});
				totalPriceText.textContent = (totalPrice / 100).toFixed(2).replace('.', ',');
			}
		});
	});
</script>

@endsection