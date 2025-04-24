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
			$table->unsignedInteger('discount_value');
			$table->date('valid_from');
			$table->date('valid_until');
			$table->unsignedInteger('max_uses')->nullable();
			$table->unsignedInteger('used_count')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('discounts');
	}
};
