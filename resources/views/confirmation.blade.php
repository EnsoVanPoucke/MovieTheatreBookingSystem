@extends('layouts.booking')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-10 font-mono text-sm text-black bg-[#fefefe]">

	{{-- Header --}}
	<div class="text-center border-b border-black pb-4 mb-6">
		<h1 class="uppercase tracking-widest font-bold text-lg">Booking Confirmation</h1>
		<p class="text-base">Please keep this ticket for entry</p>
	</div>

	@if (!empty($bookingData['tickets']))
	@foreach ($bookingData['tickets'] as $ticket)
	<div class="border border-black mb-8 bg-white">

		{{-- filmXperience logo --}}
		<div class="bg-[#202020]">
			<img src="{{ asset('images/icons/filmXperience.png') }}"
				alt="FilmXperience"
				class="w-[250px] h-[50px] mx-auto">
		</div>

		{{-- Top Section: Film Title --}}
		<div class="border-b border-dashed border-black mb-3 py-2">
			<p class="uppercase font-bold tracking-wide text-2xl">{{ strtoupper($ticket['title']) }}</p>
		</div>

		{{-- Details Block --}}
		<div class="grid grid-cols-2 gap-4">
			<div>
				<p class="text-base uppercase text-gray-600">Date</p>
				<p class="text-lg font-bold">{{ $ticket['date'] }}</p>
			</div>
			<div>
				<p class="text-base uppercase text-gray-600">Time</p>
				<p class="text-lg font-bold">{{ $ticket['time'] }}</p>
			</div>
			<div>
				<p class="text-base uppercase text-gray-600">Row</p>
				<p class="text-lg font-bold">{{ $ticket['seat_row'] }}</p>
			</div>
			<div>
				<p class="text-base uppercase text-gray-600">Seat</p>
				<p class="text-lg font-bold">{{ $ticket['seat_number'] }}</p>
			</div>
			<div>
				<p class="text-base uppercase text-gray-600">Screen</p>
				<p class="text-4xl font-bold">#{{ $ticket['screen_number'] }}</p>
			</div>
		</div>

		{{-- "Perforated" Divider --}}
		<div class="mt-4 mb-3 text-center text-[10px] text-gray-400">
			- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		</div>

		{{-- QR Code --}}
		<div class="text-center">
			<img src="{{ asset('images/QRcodes/sample-qr-code.png') }}"
				alt="QR Code"
				class="inline-block w-[120px] h-[120px]">
		</div>

		{{-- Footer Note --}}
		<p class="mt-2 text-center text-sm text-gray-500 italic">Present this ticket at entrance. No refunds or exchanges.</p>
	</div>
	@endforeach
	@else
	<p class="text-red-500 text-center">No booking data found.</p>
	@endif
</div>
@endsection