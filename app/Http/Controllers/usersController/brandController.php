<?php

namespace App\Http\Controllers\usersController;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\brand;
use App\Models\Users\user;
use Illuminate\Http\Request;

class brandController extends Controller {
	function brandPage() {
		$userId = new helper();
		if ($userId::UserId()) {
			$userData = user::findOrFail($userId::UserId());
			return view("users.brand", compact("userData"));
		}
	}

	function createBrand(Request $request) {
		$userId = new helper();
		$createBrand = new brand();
		$createBrand->name = $request->brandName;
		$createBrand->usersId = $userId::UserId();

		return $createBrand->save();
	}
	function getBrand() {
		$userId = new helper();
		$getBrand = brand::where("usersId", $userId::UserId())->get();
		return $getBrand;
	}

	function brandShow(Request $request) {
		$brandShowData = brand::findOrFail($request->braShowid);
		return $brandShowData;
	}

	function brandUpdate(Request $request) {
		$brandUpdate = brand::findOrFail($request->brandUpid);
		$brandUpdate->name = $request->brandUpName;
		return $brandUpdate->update();
	}

	function brandDelete(Request $request) {
		$brandDelete = brand::findOrFail($request->deleteId);
		return $brandDelete->delete();
	}
}
