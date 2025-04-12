<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Register</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@livewireStyles
</head>

<body>

	<div class="min-h-screen bg-gray-100">
		<main>
			@yield('content')
		</main>
	</div>
	@livewireScripts
</body>
</html>