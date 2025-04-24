<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up() {
		Schema::create('pricings', function (Blueprint $table) {
			$table->unsignedBigInteger('movie_id');
			$table->unsignedSmallInteger('single_seat_price');
			$table->unsignedSmallInteger('duo_seat_price');

			$table->primary(['movie_id']);

			$table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('pricing');
	}
};
