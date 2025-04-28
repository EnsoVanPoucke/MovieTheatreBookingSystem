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

		<form id="deleteEventForm" class="mt-6">
			<input type="hidden" id="delete_event_id" name="event_id" />
			<x-delete-button type="submit" class="deleteBtn">Delete</x-delete-button>
		</form>
	</div>

	<!-- Delete Confirmation Modal -->
	<div id="deleteConfirmModal" class="relative z-100 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
		<div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

		<div class="fixed inset-0 z-10 w-screen overflow-y-auto">
			<div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
				<div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
					<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
						<div class="sm:flex sm:items-start">
							<div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
								<svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
								</svg>
							</div>
							<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
								<h3 class="text-base font-semibold text-gray-900" id="modal-title">Delete Event</h3>
								<div class="mt-2">
									<p class="text-sm text-gray-500">Are you sure you want to delete this event?<br>This action cannot be undone!</p>
								</div>
							</div>
						</div>
					</div>
					<div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
						<button id="confirmDeleteBtn" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">
							Delete
						</button>
						<button id="cancelDeleteBtn" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto">
							Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="module" src="{{ asset('js/autocomplete.js') }}"></script>

</div>

@endsection