<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('showtimes', function (Blueprint $table) {
			$table->id('showtime_id');
			$table->date('show_date');
			$table->time('show_time');
			$table->id('screenroom_id');
			$table->id('movie_id');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('showtimes');
	}
};
