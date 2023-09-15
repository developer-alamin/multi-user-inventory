<?php

namespace App\Http\Controllers\usersController;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\brand;
use App\Models\Users\category;
use App\Models\Users\customer;
use App\Models\Users\invoice;
use App\Models\Users\product;
use App\Models\Users\sales;
use App\Models\Users\user;
use Carbon\Carbon;

class dashboardController extends Controller {
	function dashboard() {
		$userId = new helper();
		if ($userId::UserId()) {
			$userData = user::findOrFail($userId::UserId());
			$customer = customer::where("usersId", $userId::UserId())->count("id");
			$category = category::where("usersId", $userId::UserId())->count("id");
			$brand = brand::where("usersId", $userId::UserId())->count("id");
			$product = product::where("usersId", $userId::UserId())->count("id");
			$sales = sales::where("usersId", $userId::UserId())->count("id");
			$invoice = invoice::where("usersId", $userId::UserId())->count("id");
			$invTotalTaka = invoice::where("usersId", $userId::UserId())->sum("payable");
			$vat = invoice::where("usersId", $userId::UserId())->sum("vat");

			$salesChart = sales::select("*")->where("usersId", $userId::UserId())->get()->groupBy(function ($data) {
				return Carbon::parse($data->date)->format("D");
			});

			$salesDayKey = [];
			$salesDayCount = [];
			foreach ($salesChart as $salesKey => $salesData) {
				$salesDayKey[] = $salesKey;
				$salesDayCount[] = $salesData->count();
			}

			$invChart = invoice::select("*")->where("usersId", $userId::UserId())->get()->groupBy(function ($data) {
				return Carbon::parse($data->date)->format("D");
			});

			$InvDayKey = [];
			$InvDayCount = [];
			foreach ($invChart as $invChartKey => $invChartData) {
				$InvDayKey[] = $invChartKey;
				$InvDayCount[] = $invChartData->count();
			}
			return view("users.dashboard", compact('userData', 'customer', "category", "brand", "product", "sales", "invoice", "invTotalTaka", "vat", "salesDayKey", "salesDayCount", "InvDayKey", "InvDayCount"));
		}
	}
}
