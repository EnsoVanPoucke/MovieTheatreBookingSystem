<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('seats', function (Blueprint $table) {
			$table->date('show_date');
			$table->time('show_time');
			$table->unsignedInteger('screenroom_number');
			$table->unsignedInteger('seat_number');
			$table->integer('row_number');
			$table->integer('seat_status');

			$table->primary(['show_date', 'show_time', 'screenroom_number', 'seat_number']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('seats');
	}
};
