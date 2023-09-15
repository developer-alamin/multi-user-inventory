<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->char("name");
			$table->integer("rate");
			$table->integer("quantity");
			$table->char("brand");
			$table->char("category");
			$table->integer("status");
			$table->foreignId("usersId");
			$table->string("photo");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('products');
	}
};
