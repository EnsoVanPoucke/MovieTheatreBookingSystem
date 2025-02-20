@extends('layouts.app')

@section('content')

{{-- Include CSS and JavaScript via Vite --}}
@vite(['resources/css/rooms.css'])

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- <div class="bg-white mx-auto my-[60px] py-5 flex justify-center"> -->
<div class="p-4">
	<h1 class="text-3xl font-bold">Selecteer je stoelen</h1>
</div>

<div class="mx-auto my-[60px] py-5 flex justify-center">


	<!--  -->
	<div class="roomWidth{{ $booking['selection-screenroom'] }}">



		<div>
			<div id="screen"></div>
		</div>
		<div class="container">
			<div id="room-wrapper">

				<?php $globalSeatNumber = 0 ?>
				<?php $rowNumber = 0 ?>

				<!-- begin loop -->
				@foreach ($roomGridBlueprint as $rowIndex => $row)
				<div class="row flex space-x-0"> <!-- Use flex and remove space between items -->
					@foreach ($row as $colIndex => $seat)
					@if ($seat > 9000 && $seat <= 9200)
						<?php $rowNumber = $seat - 9000 ?>
						<div class="gridBlocks rowNumberBlocks">{{ $rowNumber }}</div>
				@elseif ($seat === 0 || $seat >= 9000)
				<div class="gridBlocks"></div>

				@else

				@if ($seat === 1 || $seat === 1001)

				<?php
				$globalSeatNumber++;
				$seatType = ($seat === 1) ? 'singleSeat' : 'duoSeat';
				$image = ($seat === 1) ? 'singleSeat.svg' : 'duoSeat.svg';
				$seatId = "$globalSeatNumber";
				?>



				<button id="{{ $seatId }}" class="seat {{ $seatType }} p-0 m-0" data-seat-type="{{ $seatType }}">
					<!-- <img src="{{ asset('images/icons/' . $image) }}" alt="{{ $seatType }} image" class="p-0 m-0"> -->
					@include('components.svg.' . $seatType)
				</button>



				@elseif ($seat === 2 || $seat === 1002)

				<?php
				$globalSeatNumber++;
				$seatType = ($seat === 2) ? 'singleSeat' : 'duoSeat';
				$image = ($seat === 2) ? 'singleSeat.svg' : 'duoSeat.svg';
				$seatId = "$globalSeatNumber";
				?>



				<button id="{{ $seatId }}" class="seat {{ $seatType }} p-0 m-0" data-seat-type="{{ $seatType }}">
					<!-- <img src="{{ asset('images/icons/' . $image) }}" alt="{{ $seatType }} image" class="p-0 m-0"> -->
					@include('components.svg.' . $seatType)
				</button>



				@elseif ($seat === 3 || $seat === 1003)

				<?php
				$globalSeatNumber++;
				$seatType = ($seat === 3) ? 'singleSeat' : 'duoSeat';
				$image = ($seat === 3) ? 'singleSeat.svg' : 'duoSeat.svg';
				$seatId = "$globalSeatNumber";
				?>

				<button id="{{ $seatId }}" class="seat {{ $seatType }} seat-status-booked p-0 m-0" data-seat-type="{{ $seatType }}" disabled>
					<!-- <img src="{{ asset('images/icons/' . $image) }}" alt="{{ $seatType }} image" class="p-0 m-0"> -->
					@include('components.svg.' . $seatType)
				</button>

				@endif
				@endif
				@endforeach
			</div>
			@endforeach
		</div>
	</div>
</div>
</div>














<!-- when button pressed, check selected seats and retrieve their number -->
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





<script>
	const roomWrapper = document.getElementById("room-wrapper");

	roomWrapper.addEventListener('mouseover', (event) => {
		const targetSeat = event.target.closest('.seat');
		if (!targetSeat || targetSeat.classList.contains('seat-status-booked')) return;
		this.handleMouseEvents('mouseover', targetSeat);
	});

	roomWrapper.addEventListener('mouseout', (event) => {
		const targetSeat = event.target.closest('.seat');
		if (!targetSeat || targetSeat.classList.contains('seat-status-booked')) return;
		this.handleMouseEvents('mouseout', targetSeat);
	});

	roomWrapper.addEventListener('click', (event) => {
		const targetSeat = event.target.closest('.seat');
		if (!targetSeat || targetSeat.classList.contains('seat-status-booked')) return;
		this.handleMouseEvents('click', targetSeat);
	});

	function handleMouseEvents(eventType, button) {

		const seatIMG = button.children[0]; // seat img
		const seatType = button.dataset.seattype;
		const seatrowDATA = button.dataset.seatRow;
		// const [seatNR, seatROW] = seatrowDATA.split('/');
		// const seatNumber = parseInt(seatNR);
		// const seatRow = parseInt(seatROW);

		if (eventType === 'mouseover') {

			// when seat is already selected, do not add a hover class!
			if (!seatIMG || seatIMG.classList.contains('seat-status-selected')) return;

			seatIMG.classList.add('seat-status-hover');

			// TOOLTIP
			// document.addEventListener('mousemove', (e) => this.updateTooltipPosition(e));
			// this.displayTooltip('block', seatNumber, seatRow, seatType);

		} else if (eventType === 'mouseout') {

			seatIMG.classList.remove('seat-status-hover');

			// TOOLTIP
			// this.displayTooltip('none', '', '', '');
			// document.removeEventListener('mousemove', (e) => this.updateTooltipPosition(e));

		} else if (eventType === 'click') {

			console.log(button);
			seatIMG.classList.toggle('seat-status-selected');

			if (seatIMG.classList.contains('seat-status-hover')) seatIMG.classList.remove('seat-status-hover');




			// when user selects a seat add class to button element...
			// button.classList.toggle('selected');

			// gebruiker zou niet in staat mogen zijn om meer seats aan te klikken dan aantal/type hij/zij gekozen voorheen heeft.

			// when selecting a seat, initiate a function

			// const rowNumber = button.dataset.rowNumber;
			// const rowSeatNumber = button.dataset.rowSeatNumber;
			// const globalSeatNumber = button.dataset.globalSeatNumber;

			// console.log("TheatreRoom.js:", button.id);

		}
	}
</script>











<script>
	// function insertVoornaam() {
	// 	console.log('tester initiated!');
	// 	let voornaam = document.getElementById("voornaam").value;

	// 	axios.post('/tester', {
	// 			voornaam: voornaam
	// 		})
	// 		.then(response => {
	// 			console.log(response.data);
	// 			alert(response.data.message);
	// 		})
	// 		.catch(error => {
	// 			console.error("Error:", error);
	// 		});
	// }
</script>

@endsection