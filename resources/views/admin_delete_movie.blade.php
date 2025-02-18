@extends('layouts.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
@vite(['resources/css/app.css', 'resources/js/app.js'])
@else
@endif


<div class="my-8">

	<h1 class="text-3xl font-bold my-5">Delete a movie</h1>

	<div class="border border-gray-900/10 rounded-md px-12">

		<form action="{{ route('schedule.movie') }}" method="POST">
			@csrf

			<div class="py-12">
				<h2 class="text-base/2 text-xl font-semibold text-gray-900">Information</h2>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">

					<div class="col-span-2">
						<label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
						<div class="mt-0">
							<input id="title"
								name="title"
								type="text"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-4">
						<label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
						<div class="mt-0">
							<textarea name="description"
								id="description"
								rows="5"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
						</div>
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<label for="director" class="block text-sm/6 font-medium text-gray-900">Director</label>
						<div class="mt-0">
							<input id="director"
								name="director"
								type="text"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<label for="cast" class="block text-sm/6 font-medium text-gray-900">Cast</label>
						<div class="mt-0">
							<textarea name="cast"
								id="cast"
								rows="2"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
						</div>
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<label for="genre" class="block text-sm/6 font-medium text-gray-900">Genre</label>
						<div class="mt-0">
							<input id="genre"
								name="genre"
								type="text"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<label for="duration" class="block text-sm/6 font-medium text-gray-900">Duration</label>
						<div class="mt-0">
							<input type="text"
								name="duration"
								id="duration"
								autocomplete="duration"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<label for="release_date" class="block text-sm/6 font-medium text-gray-900">Release date</label>
						<div class="mt-0">
							<input type="date"
								name="release_date"
								id="release_date"
								autocomplete="release_date"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<label for="image_url" class="block text-sm/6 font-medium text-gray-900">Image url</label>
						<div class="mt-0">
							<input id="image_url"
								name="image_url"
								type="text"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
					<div class="col-span-2">
						<label for="trailer_url" class="block text-sm/6 font-medium text-gray-900">Trailer url</label>
						<div class="mt-0">
							<input id="trailer_url"
								name="trailer_url"
								type="text"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
				</div>
			</div>



			<div class="py-12">

				<h2 class="text-base/2 text-xl font-semibold text-gray-900">Tickets</h2>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<label for="tarief_single_normaal" class="block text-sm/6 font-medium text-gray-900">Single seat normaal</label>
						<div class="mt-0">
							<input type="text"
								name="tarief_single_normaal"
								id="tarief_single_normaal"
								autocomplete="address-level2"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
					<div class="col-span-1">
						<label for="tarief_single_korting" class="block text-sm/6 font-medium text-gray-900">Single seat korting</label>
						<div class="mt-0">
							<input type="text"
								name="tarief_single_korting"
								id="tarief_single_korting"
								autocomplete="address-level1"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
					<div class="col-span-1">
						<label for="tarief_duo_normaal" class="block text-sm/6 font-medium text-gray-900">Duo seat normaal</label>
						<div class="mt-0">
							<input type="text"
								name="tarief_duo_normaal"
								id="tarief_duo_normaal"
								autocomplete="tarief_duo_normaal"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
					<div class="col-span-1">
						<label for="tarief_duo_korting" class="block text-sm/6 font-medium text-gray-900">Duo seat korting</label>
						<div class="mt-0">
							<input type="text"
								name="tarief_duo_korting"
								id="tarief_duo_korting"
								autocomplete="tarief_duo_korting"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
				</div>
			</div>



			<div class="py-12">

				<h2 class="text-base/2 text-xl font-semibold text-gray-900">Schedule</h2>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<label for="show_date" class="block text-sm/6 font-medium text-gray-900">Show date</label>
						<div class="mt-0">
							<input type="date"
								name="show_date"
								id="show_date"
								autocomplete="show_date"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
					<div class="col-span-1">
						<label for="show_time" class="block text-sm/6 font-medium text-gray-900">Show time</label>
						<div class="mt-0">
							<input type="time"
								name="show_time"
								id="show_time"
								autocomplete="show_time"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
					<div class="col-span-1">
						<label for="screenroom" class="block text-sm/6 font-medium text-gray-900">Screenroom</label>
						<div class="mt-0">
							<input type="number"
								name="screenroom"
								id="screenroom"
								autocomplete="screenroom"
								class="block w-full rounded-md bg-white px-3 py-2 border border-gray-400 text-base text-gray-900 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
						</div>
					</div>
				</div>
			</div>

			<div class="border-t border-gray-900/10 mt-6 flex items-center justify-end gap-x-6 py-4">
				<button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
				<button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
			</div>

		</form>

	</div>
</div>

@endsection