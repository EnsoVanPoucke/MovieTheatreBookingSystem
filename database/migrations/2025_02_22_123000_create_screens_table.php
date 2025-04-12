<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('screens', function (Blueprint $table) {
			$table->unsignedTinyInteger('screen_id', true); // Equivalent to screen_id as AUTO_INCREMENT
			$table->string('name');
			$table->text('description')->nullable();
			$table->smallInteger('capacity')->nullable();
			$table->enum('screen_type', ['3D', 'IMAX', 'Dolby Cinema', 'Laser Ultra']);
			$table->enum('sound_system', ['Dolby Surround 7.1', 'Dolby Digital', 'Dolby Atmos', 'DTS:X']);
			$table->enum('resolution', ['HD', '2K', '4K', '8K', '16K']);
			$table->boolean('has_single_seats')->default(true);
			$table->boolean('has_duo_seats')->default(false);
			$table->primary('screen_id');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('screens');
	}
};
