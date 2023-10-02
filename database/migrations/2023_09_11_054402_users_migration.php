<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('users', function (Blueprint $table) {
			$table->increments("id");
			$table->char("name", 50);
			$table->char("email");
			$table->integer("phone");
			$table->char("shop");
			$table->char("village");
			$table->integer("status");
			$table->string("photo");
			$table->string("password", 100);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		//
	}
};
