<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Users\user;

class dashboradController extends Controller {
	function dashboard() {
		$users = user::count();
		$padding = user::where("status", "!=", 1)->count();
		$approved = user::where("status", "!=", 0)->count();
		return view("admin.dashboard", compact("users", "padding", "approved"));
	}
}
