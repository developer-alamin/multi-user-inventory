<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('customers', function (Blueprint $table) {
			$table->id();
			$table->char('name', 50);
			$table->string('email');
			$table->integer("phone");
			$table->foreignId("usersId");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('customers');
	}
};
