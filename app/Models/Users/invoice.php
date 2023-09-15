<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model {
	use HasFactory;
	protected $table = "invoices";
	protected $fillable = [
		"name",
		"email",
		"phone",
		"total",
		"vat",
		"discount",
		"payable",
		"usersId",
		"date",
	];
}
