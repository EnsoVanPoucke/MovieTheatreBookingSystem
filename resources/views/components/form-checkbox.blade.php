@props(['checked' => false, 'name', 'id'])

<div class="flex items-center space-x-2 pt-4">
	<input type="hidden" name="{{ $name }}" value="0"> {{-- This ensures "0" is always sent --}}
	<input
		type="checkbox"
		id="{{ $id }}"
		name="{{ $name }}"
		value="1"
		{{ $checked ? 'checked' : '' }}
		class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
	<label for="{{ $id }}" class="text-sm text-gray-700">
		{{ $slot ?: ucfirst(str_replace('_', ' ', $name)) }}
	</label>
</div>