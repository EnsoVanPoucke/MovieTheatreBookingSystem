@extends('layouts.app')

@section('content')
<h1>Screenroom layout</h1>

<div>

	<div class="container-fluid d-flex justify-content-center">
		<div id="screen"></div>
	</div>

	<div class="container-fluid d-flex justify-content-center">
		<div id="room-wrapper"><!-- javascript loaded content --></div>
	</div>
	<div id="tooltip"></div>

</div>
@endsection

{{-- Include CSS and JavaScript via Vite --}}
@vite(['resources/css/rooms.css', 'resources/js/main.js'])