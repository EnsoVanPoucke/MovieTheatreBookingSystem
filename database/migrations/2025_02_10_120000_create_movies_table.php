<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('movies', function (Blueprint $table) {
			$table->id();
			$table->string('title', 100)->unique();
			$table->text('description');
			$table->string('director');
			$table->text('cast');
			$table->text('genre');
			$table->unsignedSmallInteger('duration');
			$table->date('release_date');
			$table->text('poster_url');
			$table->text('trailer_url')->nullable();
			$table->timestamps(); // Adds created_at & updated_at
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('movies');
	}
};
