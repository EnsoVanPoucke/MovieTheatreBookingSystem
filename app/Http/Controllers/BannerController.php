<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller {
	public function index() {
		$bannersPath = public_path('images/banners');
		$banners = [];

		if (File::exists($bannersPath)) {
			$files = File::files($bannersPath);
			foreach ($files as $file) {
				$banners[] = 'images/banners/' . $file->getFilename();
			}
		}

		return view('carousel', compact('banners'));
	}
}
