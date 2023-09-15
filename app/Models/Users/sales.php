<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model {
	use HasFactory;
	protected $table = "sales";
	protected $fillable = [
		"name",
		"quantity",
		"rate",
		"total",
		"usersId",
		"invoice_id",
		"date",
	];
}
