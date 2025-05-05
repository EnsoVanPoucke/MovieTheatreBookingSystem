@props([
'label' => '',
'id' => null,
'name' => null,
'rows' => 4,
])

<textarea
	id="{{ $id ?? $name }}"
	name="{{ $name }}"
	rows="{{ $rows }}"
	{{ $attributes->merge(['class' => 'block w-full rounded-sm bg-white px-3 py-1.5 text-base text-gray-800 outline-1 -outline-offset-1 outline-gray-400 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 sm:text-sm/6']) }}>
{{ $slot ?? '' }}
</textarea>