<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Laravel') }}</title>
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










<!-- Page Heading -->
{{--
@isset($header)
<header class="bg-white dark:bg-gray-800 shadow">
<div class="max-w-5xl mx-auto py-6 px-4">
{{ $header }}
</div>
</header>
@endisset
--}}