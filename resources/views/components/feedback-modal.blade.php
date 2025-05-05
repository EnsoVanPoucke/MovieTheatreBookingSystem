<div
	x-data="{ open: @entangle($attributes->wire('model')).defer }"
	x-show="open"
	x-transition
	x-cloak
	class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
	<div @click.away="open = false" class="bg-white rounded-xl p-6 shadow-xl max-w-md w-full">
		<div class="text-lg font-bold mb-4">{{ $title ?? 'Notification' }}</div>
		<div class="mb-4 text-gray-700">{{ $slot }}</div>
		<div class="text-right">
			<button @click="open = false" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
				Close
			</button>
		</div>
	</div>
</div>