<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model {
	use HasFactory;
	protected $table = "categories";
	protected $fillable = ["name", "usersId"];
}
