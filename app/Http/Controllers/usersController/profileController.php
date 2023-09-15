<?php

namespace App\Http\Controllers\usersController;
use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Session;

class profileController extends Controller {
	function profilePage() {
		$userId = new helper();
		if ($userId::UserId()) {
			$userData = user::findOrFail($userId::UserId());
			return view("users.profile", compact("userData"));
		}

	}
	function profileShow(Request $request) {
		$usersId = $request->id;
		$userShoData = user::findOrFail($usersId);
		return $userShoData;
	}
	function profileUpdate(Request $request) {
		if ($request->hasFile("userUpFile")) {
			$userUpFile = $request->file("userUpFile");

			$userUpName = $request->userUpName;
			$nameResize = str_replace(' ', '', $userUpName);

			$http = "http://" . $_SERVER['HTTP_HOST'] . "/";
			$userUpRanPath = "users/" . time() . "/" . date("m") . "/";

			$userUpFxx = $userUpFile->getClientOriginalExtension();

			$userUpSerLoad = $http . $userUpRanPath . $nameResize . "." . $userUpFxx;

			$userUpFile->move(public_path($userUpRanPath), $nameResize . "." . $userUpFxx);

			$userPreImg = $request->userUpImg;
			$explodeImg = explode("/", $userPreImg);
			$EendImg = end($explodeImg);
			$userFPreImg = prev($explodeImg);
			$userSPreImg = prev($explodeImg);

			$publicPath = public_path("users/" . $userSPreImg);
			if (File::exists($publicPath)) {
				File::deleteDirectory($publicPath);
			}
		} else {
			$userUpSerLoad = $request->userUpImg;
		}

		$userUpData = user::findOrFail($request->userUpId);
		$userUpData->name = $request->userUpName;
		$userUpData->email = $request->userUpEmail;
		$userUpData->phone = $request->userUpPhone;
		$userUpData->shop = $request->userUpShop;
		$userUpData->village = $request->userUpVillage;
		$userUpData->photo = $userUpSerLoad;

		return $userUpData->update();
	}

	function logout(Request $request) {
		$request->Session()->flush();
		return redirect(route("web.login"));
	}
}
