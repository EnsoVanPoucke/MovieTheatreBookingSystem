@extends('layouts.calendar')

@section('content')

<div class="mx-auto max-w-7xl p-6 sm:px-6 lg:px-8">
	<div id="calendar"></div>

	<!-- Modal for creating new screening -->
	<div id="createEventModal" class="hidden fixed top-1/4 left-1/2 transform -translate-x-1/2 bg-white border border-gray-300 p-6 z-50 shadow-lg rounded-lg min-w-[450px]">
		<h3 class="text-xl font-semibold mb-4">New Screening</h3>
		<form id="createEventForm">

			<div class="col-span-1 mb-2">
				<x-form-label for="start">Start:</x-form-label>
				<x-form-input id="start" name="start" type="text" />
			</div>

			<div class="col-span-2 mb-2">
				<x-form-label for="movie_title">Movie title:</x-form-label>
				<x-form-input id="movie_title" name="movie_title" type="text" autocomplete="off" />
				<div id="movie_title_suggestions" class="absolute bg-white mt-1 rounded-md shadow-md z-10 max-h-60 overflow-auto w-auto"></div> <!-- Suggestions container -->
				<input id="movie_id" name="movie_id" type="hidden" />
			</div>

			<div class="col-span-1 mb-2">
				<x-form-label for="screen_number">Screen Number:</x-form-label>
				<x-form-input id="screen_number" name="screen_number" type="number" />
			</div>

			<div class="col-span-2 mb-2">
				<x-form-label for="break_duration">Break Duration (minutes):</x-form-label>
				<x-form-input id="break_duration" name="break_duration" type="number" value="0" />
			</div>

			<div class="col-span-1">
				<x-form-checkbox id="is_public" name="is_public">public</x-form-checkbox>
			</div>

			{{-- Blade Component Buttons --}}
			<div class="mt-6 flex items-center justify-end gap-2">
				<x-secondary-button type="button" id="closeCreateModalBtn">Cancel</x-secondary-button>
				<x-primary-button type="submit" class="saveBtn">Save</x-primary-button>
			</div>
		</form>
	</div>


	<!-- Modal for updating/deleting existing screening -->
	<div id="updateEventModal" class="hidden fixed top-1/4 left-1/2 transform -translate-x-1/2 bg-white border border-gray-300 p-6 z-50 shadow-lg rounded-lg min-w-[450px]">
		<h3 class="text-xl font-semibold mb-4">Update Screening</h3>

		{{-- Update Form --}}
		<form id="updateEventForm">
			<div class="col-span-1">
				<x-form-checkbox id="is_public_forupdate" name="is_public">public</x-form-checkbox>
			</div>

			<div class="mt-6 flex items-center justify-end gap-2">
				<x-secondary-button type="button" id="closeUpdateModalBtn">Cancel</x-secondary-button>
				<x-primary-button type="submit" class="updateBtn">Update</x-primary-button>
			</div>
		</form>

		{{-- Delete Form --}}
		<form id="deleteEventForm" class="mt-6">
			<input type="hidden" id="delete_event_id" name="event_id" />
			<x-delete-button type="submit" class="deleteBtn">Delete</x-delete-button>
		</form>
	</div>

	<script type="module" src="{{ asset('js/autocomplete.js') }}"></script>

</div>

@endsection