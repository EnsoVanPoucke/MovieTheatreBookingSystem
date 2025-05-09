@extends('layouts.admin')

@section('content')

<div class="mx-auto max-w-6xl p-6 sm:px-6 lg:px-8">

	<h1 class="text-3xl font-bold my-5">Add New Movie</h1>

	@if (session('success'))
	<div class="text-green-500">
		{{ session('success') }}
	</div>
	@endif

	<div class="border border-gray-900/10 rounded-md px-12">

		<form action="{{ route('add.movie') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="py-12">
				<h2 class="text-base/2 text-xl font-semibold text-gray-900">Information</h2>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<x-form-label for="title">Title</x-form-label>
						<x-form-input id="title" name="title" type="text" :value="old('title')" />
						<x-input-error :messages="$errors->get('title')" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-4">
						<x-form-label for="description" label="Description" />
						<x-form-textareafield id="description" name="description" :value="old('description')" />
						<x-input-error :messages="$errors->get('description')" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<x-form-label for="director">Director</x-form-label>
						<x-form-input id="director" name="director" type="text" :value="old('director')" />
						<x-input-error :messages="$errors->get('director')" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-4">
						<x-form-label for="cast" label="Cast" />
						<x-form-textareafield id="cast" name="cast" :value="old('cast')" />
						<x-input-error :messages="$errors->get('cast')" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<x-form-label for="genre">Genre</x-form-label>
						<x-form-input id="genre" name="genre" type="text" :value="old('genre')" />
						<x-input-error :messages="$errors->get('genre')" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<x-form-label for="duration">Duration</x-form-label>
						<x-form-input id="duration" name="duration" type="number" :value="old('duration')" />
						<x-input-error :messages="$errors->get('duration')" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<x-form-label for="release_date">Release date</x-form-label>
						<x-form-input id="release_date" name="release_date" type="date" :value="old('release_date')" />
						<x-input-error :messages="$errors->get('release_date')" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<x-form-label for="poster_url">Poster url</x-form-label>
						<x-form-input id="poster_url" name="poster_url" type="text" :value="old('poster_url')" />
						<x-input-error :messages="$errors->get('poster_url')" />
					</div>
					<div class="col-span-2">
						<x-form-label for="trailer_url">Trailer url</x-form-label>
						<x-form-input id="trailer_url" name="trailer_url" type="text" :value="old('trailer_url')" />
						<x-input-error :messages="$errors->get('trailer_url')" />
					</div>
				</div>
			</div>

			<div class="py-12">
				<h2 class="text-base/2 text-xl font-semibold text-gray-900">Pricings</h2>
				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<x-form-label for="tarief_single_normaal">Single seat normaal</x-form-label>
						<x-form-input id="tarief_single_normaal" name="tarief_single_normaal" type="number" :value="old('tarief_single_normaal')" />
						<x-input-error :messages="$errors->get('tarief_single_normaal')" />
					</div>
					<div class="col-span-1">
						<x-form-label for="tarief_duo_normaal">Duo seat normaal</x-form-label>
						<x-form-input id="tarief_duo_normaal" name="tarief_duo_normaal" type="number" :value="old('tarief_duo_normaal')" />
						<x-input-error :messages="$errors->get('tarief_duo_normaal')" />
					</div>
				</div>
			</div>

			<div class="border-t border-gray-900/10 mt-6 flex items-center justify-end gap-x-6 py-4">
				<x-secondary-button type="reset">Reset</x-secondary-button>
				<x-primary-button>Continue</x-primary-button>
			</div>
		</form>
	</div>
</div>

@endsection