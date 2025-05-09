@extends('layouts.admin')

@section('content')

<div class="mx-auto max-w-6xl p-6 sm:px-6 lg:px-8">

	<h1 class="text-3xl font-bold my-5">Delete Movie</h1>

	@if (session('success'))
	<div class="text-green-500">
		{{ session('success') }}
	</div>
	@endif

	<div class="border border-gray-900/10 rounded-md px-12">

		<form action="{{ route('delete.movie') }}" method="POST" enctype="multipart/form-data">
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

				<div class="border-t border-gray-900/10 mt-6 flex items-center justify-end gap-x-6 py-4">
					<x-secondary-button type="reset">Reset</x-secondary-button>
					<x-danger-button>Delete</x-danger-button>
				</div>
		</form>
	</div>
</div>

@endsection