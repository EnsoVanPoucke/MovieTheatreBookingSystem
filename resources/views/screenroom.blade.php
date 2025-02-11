@extends('layouts.app')

@section('content')
<!-- <div class="bg-white mx-auto my-5 py-5 flex justify-center"> -->
<div class="mx-auto my-5 py-5 flex justify-center">
	<div>
		<div>
			<div id="screen"></div>
		</div>
		<div class="container">
			<div id="room-wrapper"><!-- javascript loaded content --></div>
		</div>
	</div>
</div>
@endsection

{{-- Include CSS and JavaScript via Vite --}}
@vite(['resources/css/rooms.css', 'resources/js/main.js'])






<!-- <div id="tooltip"></div> -->