@extends('layouts.booking')

@vite(['resources/css/rooms.css'])

@section('content')

<div class="mx-auto max-w-5xl py-[30px] sm:px-6 lg:px-8 flex justify-center">
	<h1 class="text-3xl font-bold">Selecteer je zitplaatsen</h1>
</div>
<div class="flex justify-center mb-[15px]">
	<p id="text-seats-quantity" class="text-lg font-medium text-gray-500"></p>
</div>

{{-- change this - get the new values from array --}}
<input type="hidden" id="maxQuantities" name="maxQuantities" value="{{ $booking->totalSeats }}">
<input type="hidden" id="maxQuantitiesSingleSeats" name="maxQuantitiesSingleSeats" value="{{ $booking->totalSingleSeats }}">
<input type="hidden" id="maxQuantitiesDuoSeats" name="maxQuantitiesDuoSeats" value="{{ $booking->totalDuoSeats }}">

{{-- room and button --}}
<div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 flex justify-center">
	<div class="roomWidth{{ $booking->selection_screenroom }}">
		<div>
			<div id="screen"></div>
		</div>
		<div class="container">
			<div id="room-wrapper">

				<?php $globalSeatNumber = 0 ?>
				<?php $seatNumber = 0 ?>
				<?php $rowNumber = 0 ?>

				@foreach ($roomGridBlueprint as $rowIndex => $row)
				<div class="row flex space-x-0">
					@foreach ($row as $colIndex => $seat)
					@if ($seat > 9000 && $seat <= 9200)
						<?php $rowNumber = $seat - 9000 ?>
						<div class="gridBlocks rowNumberBlocks">{{ $rowNumber }}</div>
				@elseif ($seat === 0 || $seat >= 9000)
				<div class="gridBlocks"></div>
				@else

				{{-- if seat is available --}}
				@if ($seat === 1 || $seat === 1001)
				<?php
				$globalSeatNumber++;
				$seatNumber++;
				$seatType = ($seat === 1) ? 'singleSeat' : 'duoSeat';
				$image = ($seat === 1) ? 'singleSeat.svg' : 'duoSeat.svg';
				$seatId = (string) $globalSeatNumber;
				?>
				<div class="chk_parent">
					<input type="checkbox" name="{{ $seatId }}" id="{{ $seatId }}" class="seat {{ $seatType }}" data-seat-type="{{ $seatType }}" data-seat-number="{{ $seatNumber }}" data-row-number="{{ $rowNumber }}">
					@include('components.svg.' . $seatType, ['color' => $color ?? '#bfcbcc'])
				</div>


				{{-- if seat is pending --}}
				{{--
				@elseif ($seat === 2 || $seat === 1002)
				<?php
				$globalSeatNumber++;
				$seatNumber++;
				$seatType = ($seat === 2) ? 'singleSeat' : 'duoSeat';
				$image = ($seat === 2) ? 'singleSeat.svg' : 'duoSeat.svg';
				$seatId = (string) $globalSeatNumber;
				?>
				--}}
				{{-- some component for pending here --}}


				{{-- if seat is booked --}}
				@elseif ($seat === 3 || $seat === 1003)
				<?php
				$globalSeatNumber++;
				$seatNumber++;
				$seatType = ($seat === 3) ? 'singleSeat' : 'duoSeat';
				$image = ($seat === 3) ? 'singleSeat.svg' : 'duoSeat.svg';
				$seatId = (string) $globalSeatNumber;
				?>
				<div class="svg_parent">
					@include('components.svg.' . $seatType, ['color' => $color ?? '#556060'])
				</div>
				@endif
				@endif
				@endforeach
				<?php $seatNumber = 0 ?>
			</div>
			@endforeach
		</div>
	</div>
	<div class="mx-auto my-[60px] flex justify-center">
		<x-btn-verder id="btnVerder">Verder</x-btn-verder>
	</div>
</div>

{{-- hidden data --}}
<div>
	<p data-booking-title="{{ $booking->selection_title }}"></p>
	<p data-booking-date="{{ \Carbon\Carbon::parse($booking->selection_date)->format('Y-m-d') }}"></p>
	<p data-booking-time="{{ $booking->selection_time }}"></p>
	<p data-booking-screenroom="{{ $booking->selection_screenroom }}"></p>
</div>

{{-- javascripts --}}
<script src="{{ asset('js/roomSelectListeners.js') }}"></script>
<script src="{{ asset('js/requestBooking.js') }}"></script>

@endsection