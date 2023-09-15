<?php

namespace App\Http\Controllers\frontendController;

use App\Http\Controllers\Controller;

class homeController extends Controller {
	function home() {
		return view("frontend.home");
	}
}
