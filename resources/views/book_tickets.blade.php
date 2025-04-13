@extends('layouts.layoutBooking')

@section('content')

<div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-8">
	<div>
		<h2 class="text-3xl font-semibold mb-4"><strong>{{ $movieScreeningData->movie_title }}</strong></h2>
		<p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($movieScreeningData->screening_date)->format('l d M Y') }}</p>
		<p><strong>Tijd:</strong> {{ \Carbon\Carbon::parse($movieScreeningData->screening_time)->format('H:i') }}</p>
		<p><strong>Zaal:</strong> {{ $movieScreeningData->screen_number }}</p>

		@if ($movieTarieven)

		<form action="{{ route('booking.showroom') }}" method="POST">
			@csrf

			<div class="grid grid-cols-4 gap-4"
				x-data="{ selectedTickets: {}, totalPrice: 0 }"
				x-init="totalPrice = Object.values(selectedTickets).reduce((sum, val) => sum + val, 0);">

				<div class="col-span-1">
					<img src="{{ asset('images/movieposters/' . $movieScreeningData->movie->poster_url) }}"
						alt="{{ $movieScreeningData->movie->title }} Image">
				</div>

				<!-- Livewire select options -->
				<div class="col-span-3 flex-auto">
					<div id="select-container">
						@foreach($movieTarieven as $index => $tarief)
						<div class="flex border-t border-gray-900/20 py-4 justify-between">
							<!-- Seat Label -->
							<div class="tickets-list-item-label flex items-center">
								<h1 class="text-2xl font-semibold text-gray-700">{{ $tarief->seat_label }}</h1>
							</div>

							<div class="flex gap-4">
								<!-- Seat Price -->
								<div class="tickets-price-item flex items-center">
									<h1 class="text-2xl font-semibold text-blue-900">
										{{ number_format($tarief->price / 100, 2, ',', '.') }} &euro;
									</h1>
								</div>

								<!-- Seat Quantity Selection -->
								<div class="price-item-container flex items-center gap-5">
									<div class="relative">
										<x-form-select
											name="quantity[{{ $index }}]"
											price="{{ $tarief->price }}"
											type="{{ $tarief->{'seat_type'} }}"
											pricecategory="{{ $tarief->{'price_category'} }}"
											wire:model="quantity.{{ $index }}"
											x-on:change="selectedTickets[{{ $index }}] = $event.target.value * {{ $tarief->price }}; 
												totalPrice = Object.values(selectedTickets).reduce((sum, val) => sum + val, 0);">
										</x-form-select>

										<!-- Hidden input to submit the ticket price -->
										<input type="hidden" name="category[{{ $index }}]" value="{{ $tarief->seat_category }}">
										<input type="hidden" name="type[{{ $index }}]" value="{{ $tarief->seat_type }}">
										<input type="hidden" name="pricecategory[{{ $index }}]" value="{{ $tarief->price_category }}">
										<input type="hidden" name="price[{{ $index }}]" value="{{ $tarief->price }}">
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>

				<!-- Blade button -->
				<div class="col-span-4 flex items-center justify-end bg-blue-600 py-4">
					@if(session('error'))
					<div class="flex items-center bg-red-600 mr-4">
						<h2 class="font-semibold text-white m-1">{{ session('error') }}</h2>
					</div>
					@endif
					<div class="flex items-center">
						<h2 id="total-price" class="text-2xl font-semibold text-white"
							x-text="(totalPrice / 100).toFixed(2).replace('.', ',') + ' €'">
						</h2>
					</div>
					<div class="flex items-center mx-4">
						<x-btn-verder id="btnVerder">Verder</x-btn-verder>
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