@extends('layouts.admin')

@section('content')

<div class="mx-auto max-w-6xl p-6 sm:px-6 lg:px-8">

	<h1 class="text-3xl font-bold my-5">Add New Movie</h1>

	@if (session('success'))
	<div class="text-green-500">
		{{ session('success') }}
	</div>
	@endif

	@error('screenroom')
	<div class="text-red-500">{{ $message }}</div>
	@enderror

	<div class="border border-gray-900/10 rounded-md px-12">

		<form action="{{ route('add.movie') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="py-12">
				<h2 class="text-base/2 text-xl font-semibold text-gray-900">Information</h2>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<x-form-label for="title">Title</x-form-label>
						<x-form-input id="title" name="title" type="text" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-4">
						<x-form-label for="description" label="Description" />
						<x-form-textareafield id="description" name="description" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<x-form-label for="director">Director</x-form-label>
						<x-form-input id="director" name="director" type="text" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-4">
						<x-form-label for="cast" label="Cast" />
						<x-form-textareafield id="cast" name="cast" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<x-form-label for="genre">Genre</x-form-label>
						<x-form-input id="genre" name="genre" type="text" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<x-form-label for="duration">Duration</x-form-label>
						<x-form-input id="duration" name="duration" type="number" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<x-form-label for="release_date">Release date</x-form-label>
						<x-form-input id="release_date" name="release_date" type="date" />
					</div>
				</div>

				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-2">
						<x-form-label for="poster_url">Poster url</x-form-label>
						<x-form-input id="poster_url" name="poster_url" type="text" />
					</div>
					<div class="col-span-2">
						<x-form-label for="trailer_url">Trailer url</x-form-label>
						<x-form-input id="trailer_url" name="trailer_url" type="text" />
					</div>
				</div>

				{{--
					<div class="mt-4 col-span-full">
						<x-form-label for="poster">Poster</x-form-label>
						<div class="mt-0 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
							<div class="text-center">
							<svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
								<path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
							</svg>
							<div class="mt-4 flex text-sm/6 text-gray-600">
								<label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
									<span>Upload a file</span>
									<input id="file-upload" name="poster" type="file" class="sr-only" onchange="previewImage(event)">
								</label>
								<p class="pl-1">or drag and drop</p>
							</div>
							<p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
							<div class="mt-4">
								<img id="image-preview" class="hidden max-w-xs" />
							</div>
						</div>
					</div>
				</div>
				
				<script>
					function previewImage(event) {
						const file = event.target.files[0]; // Get the selected file
						if (file) {
							const reader = new FileReader();
							reader.onload = function(e) {
								const preview = document.getElementById("image-preview");
								preview.src = e.target.result; // Set the image source
								preview.classList.remove("hidden"); // Make it visible
							};
							reader.readAsDataURL(file); // Convert to base64
						}
					}
				</script>
				--}}
			</div>

			<div class="py-12">
				<h2 class="text-base/2 text-xl font-semibold text-gray-900">Pricings</h2>
				<div class="mt-4 grid grid-cols-4 gap-x-4 gap-y-4">
					<div class="col-span-1">
						<x-form-label for="tarief_single_normaal">Single seat normaal</x-form-label>
						<x-form-input id="tarief_single_normaal" name="tarief_single_normaal" type="number" />
					</div>
					<div class="col-span-1">
						<x-form-label for="tarief_duo_normaal">Duo seat normaal</x-form-label>
						<x-form-input id="tarief_duo_normaal" name="tarief_duo_normaal" type="number" />
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