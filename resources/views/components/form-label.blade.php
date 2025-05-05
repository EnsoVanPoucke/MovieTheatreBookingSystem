@props(['label'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-900 mb-0']) }}>
    {{ $label ?? $slot }}
</label>