<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model {
	use HasFactory;
	protected $table = "brands";
	protected $fillable = ["name", "usersId"];
}
