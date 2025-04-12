<div x-data="{ 
        quantity: @entangle('quantity'), 
        price: @js($price) / 100 
    }"
	class="flex"
	x-init="$watch('quantity', value => { 
        $dispatch('update-total', { index: @js($index), total: value * price });
    })">

	<div class="tickets-list-item-label flex items-center">
		<span class="text-2xl font-semibold text-gray-700/100" x-text="price.toFixed(2).replace('.', ',') + ' €'"></span>
	</div>

	<select x-model="quantity" class="text-base ml-6">
		@for ($i = 0; $i <= 10; $i++)
			<option value="{{ $i }}">{{ $i }}</option>
		@endfor
	</select>
</div>