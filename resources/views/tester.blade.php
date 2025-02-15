@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="p-4">
	<h1 class="text-3xl font-bold">Tester</h1>

	<input type="text" id="voornaam" placeholder="Enter voornaam" class="border p-2">
	<button onclick="insertVoornaam()" class="bg-blue-500 text-white px-4 py-2 mt-2">Submit</button>
</div>

<script>
	function insertVoornaam() {
		console.log('tester initiated!');
		let voornaam = document.getElementById("voornaam").value;

		axios.post('/tester', {
				voornaam: voornaam
			})
			.then(response => {
				console.log(response.data);
				alert(response.data.message);
			})
			.catch(error => {
				console.error("Error:", error);
			});
	}
</script>



<script>
	// function insertVoornaam() {

	// 	console.log('tester initiated!');
	// 	// console.log("CSRF Token from meta:", document.querySelector('meta[name="csrf-token"]').content);


	// 	let voornaam = document.getElementById("voornaam").value;

	// 	axios.post('/tester', {
	// 			voornaam: voornaam
	// 		}, {
	// 			headers: {
	// 				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
	// 				'X-Requested-With': 'XMLHttpRequest',
	// 				'Accept': 'application/json', // Zorgt ervoor dat Laravel het JSON-formaat herkent
	// 				'Content-Type': 'application/json' // Wordt gebruikt om JSON te versturen
	// 			}
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