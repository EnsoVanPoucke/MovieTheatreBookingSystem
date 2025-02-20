<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('discounts', function (Blueprint $table) {
			$table->id();
			$table->string('code')->unique();
			$table->string('description')->nullable();
			$table->enum('discount_type', ['fixed', 'percentage']);
			$table->decimal('discount_value', 5, 2);
			$table->date('valid_from');
			$table->date('valid_until');
			$table->integer('max_uses')->nullable();
			$table->integer('used_count')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('discounts');
	}
};


// $table->integer('aantal_single_normaal')->nullable();
// $table->integer('aantal_single_korting')->nullable();
// $table->integer('aantal_duo_normaal')->nullable();
// $table->integer('aantal_duo_korting')->nullable();