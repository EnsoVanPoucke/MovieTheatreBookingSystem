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
			$table->date('screening_date');
			$table->time('screening_time');
			$table->unsignedInteger('screen_number'); // or unsignedTinyInteger
			$table->unsignedSmallInteger('tarief_single_normaal');
			$table->unsignedSmallInteger('tarief_single_korting');
			$table->unsignedSmallInteger('tarief_duo_normaal')->nullable();
			$table->unsignedSmallInteger('tarief_duo_korting')->nullable();

			$table->primary(['screening_date', 'screening_time', 'screen_number']);

			$table->foreign(['screening_date', 'screening_time', 'screen_number'])
				->references(['screening_date', 'screening_time', 'screen_number'])
				->on('screenings')
				->onDelete('cascade');
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