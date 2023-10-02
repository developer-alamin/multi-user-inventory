<?php

namespace App\Http\Controllers\adminController;

use App\Http\Controllers\Controller;
use App\Models\Users\brand;
use App\Models\Users\category;
use App\Models\Users\customer;
use App\Models\Users\invoice;
use App\Models\Users\product;
use App\Models\Users\sales;
use App\Models\Users\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class usersController extends Controller {
	function users() {
		return view('admin.users');
	}
	function usersInfo() {
		$users = user::all();
		return $users;
	}
	function usersShow(Request $request) {
		$usersId = $request->id;
		$userData = user::findOrFail($usersId);
		return $userData;
	}

	function adUserUpdate(Request $request) {
		$userId = $request->upId;
		$userStatus = $request->userStatus;

		$userUpData = user::findOrFail($userId);
		$userUpData->status = $userStatus;
		return $userUpData->update();

	}

	function usersDel(Request $request) {
		$userId = $request->id;
		$userDel = user::findOrFail($userId);

		$UserDelImg = $userDel->photo;

		$userEx = explode("/", $UserDelImg);
		$userEnd = end($userEx);
		$userPre = prev($userEx);
		$UserSecPrev = prev($userEx);

		brand::where("usersId", $userId)->delete();
		category::where("usersId", $userId)->delete();
		customer::where("usersId", $userId)->delete();
		invoice::where("usersId", $userId)->delete();
		$proData = product::where("usersId", $userId)->get();
		foreach ($proData as $proData) {
			$proId = $proData->id;
			$proPhoto = $proData->photo;

			$ProEx = explode("/", $proPhoto);
			$ProEnd = end($ProEx);
			$ProPre = prev($ProEx);
			$ProSecPrev = prev($ProEx);

			$proImgDelpath = public_path("product/" . $ProSecPrev);
			if (File::exists($proImgDelpath)) {
				File::deleteDirectory($proImgDelpath);
				product::destroy($proId);
			}

		}

		sales::where("usersId", $userId)->delete();

		$UserImgDelPath = public_path("users/" . $UserSecPrev);
		if (File::exists($UserImgDelPath)) {
			File::deleteDirectory($UserImgDelPath);
			return user::destroy($userId);
		}
	}
}
