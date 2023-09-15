<?php

namespace App\Http\Controllers\usersController;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\category;
use App\Models\Users\user;
use Illuminate\Http\Request;

class categoryController extends Controller {
	function categoryPage() {
		$usersId = new helper();
		if ($usersId::UserId()) {
			$userData = user::findOrFail($usersId::UserId());
			return view("users.category", compact("userData"));
		}
	}
	function createCategory(Request $request) {
		$usersId = new helper();
		$createCategory = new category();
		$createCategory->name = $request->categoryName;
		$createCategory->usersId = $usersId::UserId();
		return $createCategory->save();
	}
	function getCategory() {
		$usersId = new helper();

		$getCategory = category::where("usersId", $usersId::UserId())->get();
		return $getCategory;
	}

	function adminCategoryShow(Request $request) {
		$catShowData = category::findOrFail($request->catShowid);
		return $catShowData;
	}

	function categoryUpdate(Request $request) {
		$categoryUpdate = category::findOrFail($request->catUpId);
		$categoryUpdate->name = $request->catUpName;
		return $categoryUpdate->update();
	}
	function categoryDelete(Request $request) {
		$categoryDelete = category::findOrFail($request->catDeleteid);
		return $categoryDelete->delete();
	}
}
