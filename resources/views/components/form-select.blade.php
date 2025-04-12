@props(['name', 'price', 'type', 'pricecat', 'selected' => 0])

<div class="grid grid-cols-1">
	<select name="{{ $name }}" id="{{ $name }}" data-type="{{ $type }}" {{ $attributes->merge(['class' => 'col-start-1 row-start-1 w-full appearance-none bg-white py-3 pr-8 pl-4 text-base text-gray-800 outline-1 -outline-offset-1 outline-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm']) }}>
		@foreach(range(0, 10) as $value)
		<option value="{{ $value }}" data-price="{{ $price }}">{{ $value }}</option>
		@endforeach
	</select>
	<svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-5" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
		<path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
	</svg>
</div>