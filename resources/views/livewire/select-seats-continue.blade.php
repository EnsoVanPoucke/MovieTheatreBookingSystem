<div>
	<button wire:click="continueToCheckout" class="bg-orange-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-orange-600">
		VERDER
	</button>

	@if (session()->has('error'))
	<p class="text-red-500 mt-2">{{ session('error') }}</p>
	@endif
</div>