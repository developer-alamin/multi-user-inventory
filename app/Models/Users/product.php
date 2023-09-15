<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model {
	use HasFactory;
	protected $table = "products";
	protected $fillable = [
		"name",
		"rate",
		"quantity",
		"brand",
		"category",
		"status",
		"usersId",
		"photo",
	];
}
