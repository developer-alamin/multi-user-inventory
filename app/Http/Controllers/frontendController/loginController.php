<?php
namespace App\Http\Controllers\frontendController;

use App\Http\Controllers\Controller;
use App\Models\Users\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class loginController extends Controller {
	function login() {
		return view("frontend.login");
	}
	function loginPost(Request $request) {
		$userEmail = $request->email;
		$userPass = $request->password;
		$users = user::where("email", $userEmail)->first();
		if (isset($users)) {
			if (Hash::check($userPass, $users->password)) {
				if (!($users->status == 0 || $users->status == null)) {
					$request->Session()->put('userId', $users->id);
					return response()->json([
						'status' => 200,
						'success' => "Success",
					]);
				} else {
					return response()->json([
						'status' => 200,
						'faild' => "Your Account Not Approved !",
					]);
				}
			} else {
				return response()->json([
					'status' => 200,
					'password' => "Incorrect Password",
				]);
			}
		} else {
			return response()->json([
				'status' => 200,
				'email' => "Incorrect Email",
			]);
		}

	}
}