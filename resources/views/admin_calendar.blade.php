@extends('layouts.calendar')

@section('content')

<div class="mx-auto max-w-7xl p-6 sm:px-6 lg:px-8">
	<div id="calendar"></div>

	<!-- Modal for creating new screening -->
	<div id="createEventModal" class="hidden fixed top-1/4 left-1/2 transform -translate-x-1/2 bg-white border border-gray-300 p-6 z-50 shadow-lg rounded-lg min-w-[450px]">
		<h3 class="text-xl font-semibold mb-4">New Screening</h3>
		<form id="createEventForm">

			<div class="col-span-1">
				<x-form-label for="start">Start:</x-form-label>
				<x-form-input id="start" name="start" type="text" />
			</div>

			<div class="col-span-2">
				<x-form-label for="movie_id">Movie ID:</x-form-label>
				<x-form-input id="movie_id" name="movie_id" type="number" />
			</div>

			<div class="col-span-1">
				<x-form-label for="screen_number">Screen Number:</x-form-label>
				<x-form-input id="screen_number" name="screen_number" type="number" />
			</div>

			<div class="col-span-1">
				<x-form-checkbox id="is_public" name="is_public">is_public</x-form-checkbox>
			</div>

			{{-- Blade Component Buttons --}}
			<div class="mt-6">
				<x-secondary-button type="button" id="closeModalBtn">Cancel</x-secondary-button>
				<x-primary-button type="submit" class="saveBtn">Save</x-primary-button>
			</div>
		</form>
	</div>
</div>

@endsection