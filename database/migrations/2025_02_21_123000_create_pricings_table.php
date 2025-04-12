<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up() {
		Schema::create('pricing', function (Blueprint $table) {
			$table->id('movie_id');
			$table->unsignedSmallInteger('single_seat_price');
			$table->unsignedSmallInteger('duo_seat_price');

			$table->primary(['movie_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('pricing');
	}
};



// pricing_screening_date_screening_time_screen_number
// seats_screening_date_screening_time_screen_number