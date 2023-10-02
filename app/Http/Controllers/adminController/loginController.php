<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\admin\admin;
use Illuminate\Http\Request;
use Session;

class loginController extends Controller {
	function login() {
		return view("frontend.adminLogin");
	}
	function adminPLogin(Request $request) {
		$email = $request->email;
		$pass = $request->password;

		$admin = admin::where("email", $email)->where("password", $pass)->first();
		if (isset($admin)) {
			$request->Session()->put("adminId", $admin->id);
			return response()->json([
				"status" => 200,
				"success" => "Success",
			]);
		} else {
			return response()->json([
				"status" => 200,
				"faild" => "Request Faild",
			]);
		}
	}

	function logout(Request $request) {
		$request->session()->flush();
		return redirect(route("admin.login"));
	}

}
