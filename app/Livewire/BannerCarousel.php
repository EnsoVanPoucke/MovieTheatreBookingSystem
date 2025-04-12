<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;

class BannerCarousel extends Component {
	public $banners = [];

	public function mount() {
		$bannersPath = public_path('images/banners');

		if (File::exists($bannersPath)) {
			$files = File::files($bannersPath);
			foreach ($files as $file) {
				$this->banners[] = 'images/banners/' . $file->getFilename();
			}
		}
	}

	public function render() {
		return view('livewire.banner-carousel');
	}
}
