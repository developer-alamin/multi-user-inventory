<?php

namespace App\Http\Controllers\usersController;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\customer;
use App\Models\Users\user;
use Illuminate\Http\Request;
use Session;

class customerController extends Controller {

	function customerPage() {
		if (Session::has("userId")) {
			$usersId = new helper();
			$userData = user::findOrFail($usersId->UserId());
			return view("users.customer", compact("userData"));
		}

	}
	function admincreateCustomer(Request $request) {
		$usersId = new helper();
		$customer = new customer();
		$customer->name = $request->customerName;
		$customer->email = $request->customerEmail;
		$customer->phone = $request->customerPhone;
		$customer->phone = $request->customerPhone;
		$customer->usersId = $usersId::UserId();
		return $customer->save();
	}

	function adminGetCustomer() {
		$usersId = new helper();
		$getCustomer = customer::where("usersId", $usersId::UserId())->get();
		return $getCustomer;
	}

	function adminCustomerShow(Request $request) {
		$showId = $request->ShowId;
		$customerShowData = customer::findOrFail($showId);
		return $customerShowData;
	}

	function adminCustomerUPdate(Request $request) {
		$cusUpId = $request->customerUpId;
		$cusUpName = $request->custoUpName;
		$cusUpEmail = $request->custoUpEmail;
		$cusUpPhone = $request->custoUpPhone;

		$cusUpData = customer::findOrFail($cusUpId);

		$cusUpData->name = $cusUpName;
		$cusUpData->email = $cusUpEmail;
		$cusUpData->phone = $cusUpPhone;

		return $cusUpData->update();
	}

	function adminCustomerDelete(Request $request) {
		$cusDelData = customer::findOrFail($request->deleteId);
		return $cusDelData->delete();
	}
}