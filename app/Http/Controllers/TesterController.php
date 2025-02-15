<?php

namespace App\Http\Controllers;

use App\Models\Tester;
use Illuminate\Http\Request;


class TesterController extends Controller {
	public function store(Request $request) {

		$request->validate([
			'voornaam' => 'required|string|max:255',
		]);

		$tester = Tester::create([
			'voornaam' => $request->voornaam,
		]);

		return response()->json([
			'success' => true,
			'message' => 'Voornaam inserted successfully!',
			'data' => $tester
		]);
	}
}


// dd($request);
