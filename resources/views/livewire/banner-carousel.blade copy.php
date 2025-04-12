<div class="flex items-center justify-center">
	<div class="bg-sky-600 relative w-full max-w-5xl overflow-hidden"
		x-data='{
		currentSlide: 0, 
		banners: @json($banners),
			autoSlide() {
				setInterval(() => {
					this.currentSlide = (this.currentSlide + 1) % this.banners.length;
				}, 5000);
			}
		}'
		x-init="autoSlide">

		<!-- Slides -->
		<div class="relative flex transition-transform duration-500 whitespace-nowrap"
			:style="'transform: translateX(-' + (currentSlide * 100) + '%)'"
			x-ref="carousel">

			<template x-for="(banner, index) in banners" :key="index">
				<div class="w-full min-w-full flex-shrink-0">
					<img :src="banner" class="w-full h-auto object-cover">
				</div>
			</template>
		</div>

		<!-- Prev Button -->
		<button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : banners.length - 1"
			class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/90 w-8 h-8 flex items-center justify-center rounded-full shadow-md">
			&larr;
		</button>

		<!-- Next Button -->
		<button @click="currentSlide = (currentSlide + 1) % banners.length"
			class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/90 w-8 h-8 flex items-center justify-center rounded-full shadow-md">
			&rarr;
		</button>

	</div>
</div>