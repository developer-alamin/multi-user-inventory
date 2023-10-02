<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class user extends Model {
	use HasFactory;
	protected $table = "users";
	protected $fillable = ["name", "email", "phone", "shop", "village", "status", "photo", "password"];

	public function sendOtp(): HasOne {
		return $this->hasOne(sendOtp::class);
	}
}
