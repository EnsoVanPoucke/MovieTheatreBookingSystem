<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Movies</title>

	<!-- Styles / Scripts -->
	@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@else
	@endif
	<!-- # -->
</head>

<body class="font-sans antialiased bg-gray-100">
	<div class="container mx-auto px-4">
		@yield('content')
	</div>
</body>

</html>