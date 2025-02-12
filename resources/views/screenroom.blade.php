@extends('layouts.app')

@section('content')


<!-- <pre>{{ print_r($booking, true) }}</pre> -->


<!-- <div class="bg-white mx-auto my-[60px] py-5 flex justify-center"> -->
<div class="p-4">
	<h1 class="text-3xl font-bold">Selecteer je stoelen</h1>
</div>

<div class="mx-auto my-[60px] py-5 flex justify-center">
	<div>
		<div>
			<div id="screen"></div>
		</div>
		<div class="container">
			<div id="room-wrapper"><!-- javascript loaded content --></div>
		</div>
	</div>
</div>

<div class="mx-auto my-[60px] flex justify-center">
	<form action="#" method="post" class="m-0">
		<button type="submit"
			class="bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-600">
			Verder
		</button>
	</form>
</div>


<div class="container mx-auto my-[60px]">

	<div class="bg-white shadow-md rounded-lg p-6 flex">



		<div class="w-1/3">
			<img src="{{ asset('images/movieposters/' . $booking['selection-movieposter']) }}"
				alt="{{ $booking['selection-title'] }} Image">
		</div>




		<!-- Film Informatie -->
		<div class="w-2/3 pl-6">
			<h2 class="text-2xl font-bold">{{ $booking['selection-title'] }}</h2>
			<div class="mt-4">
				<p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($booking['selection-date'])->format('d-m-Y') }}</p>
				<p><strong>Tijd:</strong> {{ $booking['selection-time'] }}</p>
			</div>
			<div class="border-t border-gray-300 my-3"></div>
			<div>
				<p><strong>Zaal:</strong> {{ $booking['selection-screenroom'] }}</p>
			</div>
			<div class="border-t border-gray-300 my-3"></div>
			<div>
				<h2 class="text-md font-semibold">Gekozen tickets</h2>
				<p>Single Normaal: <strong>{{ $booking['single-normaal'] }}</strong></p>
				<p>Single Korting: <strong>{{ $booking['single-korting'] }}</strong></p>
				<p>Duo Normaal: <strong>{{ $booking['duo-normaal'] }}</strong></p>
				<p>Duo Korting: <strong>{{ $booking['duo-korting'] }}</strong></p>
			</div>
			<div class="border-t border-gray-300 my-3"></div>
			<div>
				<h2 class="text-xl font-semibold">Totaalprijs</h2>
				<p class="text-2xl font-bold text-blue-600">{{ number_format($booking['total-price'] / 100, 2, ',', '.') }} €</p>
			</div>
		</div>
	</div>

</div>



@endsection

{{-- Include CSS and JavaScript via Vite --}}
@vite(['resources/css/rooms.css', 'resources/js/main.js'])






<!-- <div id="tooltip"></div> -->