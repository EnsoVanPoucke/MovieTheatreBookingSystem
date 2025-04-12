@extends('layouts.booking')

@section('content')

<div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-8">
	<div class="bg-white p-8 shadow rounded-lg">
		<h1 class="text-2xl font-semibold text-gray-800">Booking confirmed!</h1>
		<p class="text-gray-600 mt-2">Your seats have been successfully booked.</p>

		@if (!empty($bookingData['tickets']))
		<div class="my-10">
			<h2 class="mb-2 text-2xl font-bold text-gray-800">Your tickets</h2>

			<div class="space-y-6">
				@foreach ($bookingData['tickets'] as $ticket)
				<div class="bg-white border-4 border-gray-900 overflow-hidden">

					{{-- Movie Title Banner (Full Width) --}}
					<div class="bg-gray-900 flex text-white py-3 px-5 text-3xl font-semibold text-center">
						{{ $ticket['title'] }}
					</div>

					{{-- Ticket Details, Screen Room, & QR Code --}}
					<div class="flex items-center justify-between p-6">

						{{-- Screen Room (Far Left) --}}
						<div class="flex flex-col justify-center items-center w-[200px] h-[200px] border-2 border-gray-300 gap-2">
							<p class="text-gray-500 text-lg font-semibold">SCREEN</p>
							<p class="text-7xl font-semibold text-gray-900">{{ $ticket['screen_number'] }}</p>
						</div>

						{{-- Ticket Details (Center) --}}
						<div class="flex gap-8">
							<div class="flex flex-col items-center">
								<p class="text-gray-500 text-medium font-semibold">Date</p>
								<p class="text-lg font-semibold text-stone-800">{{ $ticket['date'] }}</p>
							</div>
							<div class="flex flex-col items-center">
								<p class="text-gray-500 text-medium font-semibold">Time</p>
								<p class="text-lg font-semibold text-stone-800">{{ $ticket['time'] }}</p>
							</div>
							<div class="flex flex-col items-center">
								<p class="text-gray-500 text-medium font-semibold">Row</p>
								<p class="text-lg font-semibold text-stone-800">{{ $ticket['seat_row'] }}</p>
							</div>
							<div class="flex flex-col items-center">
								<p class="text-gray-500 text-medium font-semibold">Seat</p>
								<p class="text-lg font-semibold text-stone-800">{{ $ticket['seat_number'] }}</p>
							</div>
						</div>

						{{-- QR Code (Far Right) --}}
						<div class="flex justify-center items-center">
							<div class="flex justify-center items-center">
								<img class="qr-code w-[200px] h-[200px]"
									src="{{ asset('images/QRcodes/sample-qr-code.png') }}"
									alt="QR">
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>

		@else
		<p class="text-red-500 mt-4">No booking data found.</p>
		@endif
	</div>
</div>

@endsection