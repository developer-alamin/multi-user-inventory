<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\admin\admin;

class profileController extends Controller {
	function adminProfile() {
		$data = admin::where("id", 1)->first();
		return view("admin.profile", compact("data"));
	}
}
