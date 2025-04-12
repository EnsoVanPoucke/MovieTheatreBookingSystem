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

				<div class="col-span-3 flex-auto">
					<div>

						@foreach($movieTarieven as $index => $item)
						<div class="flex border-t border-gray-900/20 py-4 justify-between">
							<div class="tickets-list-item-label flex items-center">
								<h1 class="text-2xl font-semibold text-gray-700/100">{{ $item['label'] }}</h1>
							</div>

							<div class="price-item-container flex items-center gap-5">
								<div class="relative">
									@livewire('ticket-quantity-selection', ['price' => $item['prijs'], 'index' => $index])
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>













				{{--
					make livewire component out of this button...
					send data through livewire class instead of post request...
				--}}

				<div class="col-span-4 flex items-center justify-end bg-blue-600 py-4">
					<div class="flex items-center">
						<h2 id="total-price" class="text-2xl font-semibold text-white" x-text="totalPrice.toFixed(2).replace('.', ',') + ' €'"></h2>
					</div>
					<div class="flex items-center mx-4">
						<a href="{{ route('SeatSelection', ['data' => encrypt(json_encode([
            				'date' => $movieScreeningData->screening_date,
            				'time' => $movieScreeningData->screening_time,
            				'screen_number' => $movieScreeningData->screen_number,
            				'movie_id' => $movieScreeningData->movie_id,
            				'title' => $movieScreeningData->movie->title
        					]))]) }}"
							class="bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-400">
							Ga Verder
						</a>
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