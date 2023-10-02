<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class sendOtp extends Model {
	use HasFactory;
	protected $table = "sendotps";
	protected $fillable = ["token", "user_id"];

	public function user(): BelongsTo {
		return $this->belongsTo(user::class);
	}
}
