<div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
	<div class="bg-sky-600 relative w-full max-w-5xl overflow-hidden"
		x-data='{
        initialIndex: 0,
        banners: @json($banners),
        carouselArray: [],
        intervalId: null,
        autoSlide() {
            this.update();
            this.intervalId = setInterval(() => {
                this.initialIndex = (this.initialIndex + 1) % this.banners.length;
                this.update();
            }, 5000);
        },
        resetInterval() {
            clearInterval(this.intervalId);
            this.autoSlide();
        },
        update() {
            this.carouselArray = [
                this.banners[(this.initialIndex - 1 + this.banners.length) % this.banners.length], // Previous banner
                this.banners[this.initialIndex], // Current banner
                this.banners[(this.initialIndex + 1) % this.banners.length] // Next banner
            ];
            //console.log("Secondary Array Updated:", this.carouselArray);
        },
    }'
		x-init="autoSlide">

		<!-- Slides -->
		<div class="relative flex transition-transform duration-500 whitespace-nowrap" x-ref="carousel">
			<!-- Only show the second index (index === 1) from the carouselArray -->
			<template x-for="(banner, index) in carouselArray" :key="index">
				<div class="w-full min-w-full flex-shrink-0"
					:style="index === 1 ? 'display: block;' : 'display: none;'">
					<img :src="banner" class="w-full h-auto object-cover">
				</div>
			</template>
		</div>

		<!-- Prev Button -->
		<button @click="initialIndex = (initialIndex > 0) ? initialIndex - 1 : banners.length - 1; update(); resetInterval()"
			class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/90 w-8 h-8 flex items-center justify-center rounded-full shadow-md">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
			</svg>
		</button>

		<!-- Next Button -->
		<button @click="initialIndex = (initialIndex + 1) % banners.length; update(); resetInterval()"
			class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/90 w-8 h-8 flex items-center justify-center rounded-full shadow-md">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
			</svg>
		</button>

	</div>
</div>