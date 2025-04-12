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
					<div>
						@foreach($movieTarieven as $index => $tarief)
						<div class="flex border-t border-gray-900/20 py-4 justify-between">
							<!-- Ticket Label -->
							<div class="tickets-list-item-label flex items-center">
								<h1 class="text-2xl font-semibold text-gray-700">{{ $tarief['label'] }}</h1>
							</div>

							<!-- Ticket Price and Quantity Selection -->
							<div class="price-item-container flex items-center gap-5">
								<div class="relative">
									<!-- Livewire Component for Quantity Selection -->
									@livewire('ticket-quantity-selection',
									['price' => $tarief['prijs'], 'index' => $index],
									key($index)
									)
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>


				<!-- livewire ga verder button -->
				<div class="col-span-4 flex items-center justify-end bg-blue-600 py-4">
					<div class="flex items-center">
						<h2 id="total-price" class="text-2xl font-semibold text-white" x-text="totalPrice.toFixed(2).replace('.', ',') + ' €'"></h2>
					</div>
					<div class="flex items-center mx-4">
						@livewire('ticket-quantity-continue', [
						'date' => $movieScreeningData->screening_date,
						'time' => $movieScreeningData->screening_time,
						'screen_number' => $movieScreeningData->screen_number,
						'movie_id' => $movieScreeningData->movie_id,
						'movie_title' => $movieScreeningData->movie->title,
						'selectedTickets' => $selectedTickets
						])
					</div>
				</div>

			</div>

		</form>

		@else
		<p>Pricing not available</p>
		@endif

	</div>
</div>

@endsection