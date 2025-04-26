<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('screenings', function (Blueprint $table) {
			$table->date('screening_date');
			$table->time('screening_time');
			$table->unsignedTinyInteger('screen_number');
			$table->foreignId('movie_id')->constrained('movies')->onDelete('cascade'); // Correct foreign key reference
			$table->unsignedTinyInteger('break_duration')->default(0); // (in minutes)
			$table->boolean('is_public')->default(false);

			$table->primary(['screening_date', 'screening_time', 'screen_number']); // Composite primary key
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('screenings');
	}
};
