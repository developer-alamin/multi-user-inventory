<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model {
	use HasFactory;
	protected $table = "users";
	protected $fillable = ["name", "email", "phone", "shop", "village", "photo", "password"];
}
