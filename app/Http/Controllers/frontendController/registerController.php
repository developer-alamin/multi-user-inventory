<?php

namespace App\Http\Controllers\frontendController;

use App\Http\Controllers\Controller;
use App\Models\Users\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller {
	function register() {
		return view("frontend.register");
	}
	function userStore(Request $request) {

		$file = $request->file("Rphoto");
		$name = $request->Rname;
		$nameResize = str_replace(" ", "", $name);

		$http = "http://" . $_SERVER['HTTP_HOST'] . "/";
		$randomPath = "users/" . time() . "/" . date("m") . "/";

		$FilePath = $file->getClientOriginalExtension();
		$serverUpload = $http . $randomPath . $nameResize . "." . $FilePath;

		$file->move(public_path($randomPath), $nameResize . "." . $FilePath);

		user::create([
			"name" => $name,
			"email" => $request->Remail,
			"phone" => $request->Rphone,
			"shop" => $request->RshopName,
			"village" => $request->Rvillage,
			"photo" => $serverUpload,
			"password" => Hash::make($request->Rpassword, ['rounds' => 10]),
		]);

	}
}
