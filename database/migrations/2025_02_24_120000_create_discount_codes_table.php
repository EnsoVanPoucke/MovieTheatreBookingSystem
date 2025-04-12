<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('discount_codes', function (Blueprint $table) {
			$table->id();
			$table->string('code');
			$table->tinyInteger('discount_percentage');
			$table->date('valid_from');
			$table->date('valid_until');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('discount_codes');
	}
};
