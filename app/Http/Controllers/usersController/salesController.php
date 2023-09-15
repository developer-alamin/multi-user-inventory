<?php

namespace App\Http\Controllers\usersController;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\customer;
use App\Models\Users\invoice;
use App\Models\Users\product;
use App\Models\Users\sales;
use App\Models\Users\user;
use Carbon\Carbon;
use Illuminate\Http\Request;

class salesController extends Controller {
	function salesPage() {
		$usersId = new helper();
		if ($usersId::UserId()) {
			$userData = user::findOrFail($usersId::UserId());
			return view("users.sales", compact("userData"));
		}
	}

	function customerPick(Request $request) {
		$cusPickData = customer::findOrFail($request->CusPickId);
		return $cusPickData;
	}
	function salProductShow() {
		$usersId = new helper();
		$salProShow = product::where("usersId", $usersId::UserId())->where("quantity", "!=", 0)->where("status", "!=", 0)->get();
		return $salProShow;
	}
	function invAddProShow(Request $request) {
		$InvAddproShow = product::findOrFail($request->InvAddProId);
		return $InvAddproShow;
	}
	function InvProductAdd(Request $request) {
		return $request;
	}

	function productPick(Request $request) {
		$productPickData = product::findOrFail($request->proPickid);
		return $productPickData;
	}
	function createSales(Request $request) {
		$usersId = new helper();
		$date = Carbon::now()->format("d-m-Y");

		$cusPickId = $request->salCusPickId;
		$cusPickData = customer::findOrFail($cusPickId);
		$invTotalTaka = $request->inputTotalTaka;
		$invPayTaka = $request->inputPayTaka;
		$invVatTaka = $request->InputVatTaka;
		$invDisTaka = $request->InputDisTaka;

		$proId = $request->InvAddid;
		$ProName = $request->name;
		$ProQty = $request->qty;
		$ProRate = $request->rate;
		$proTotalTaka = $request->total;

		$Invoice = invoice::create([
			"name" => $cusPickData->name,
			"email" => $cusPickData->email,
			"phone" => $cusPickData->phone,
			"total" => $invTotalTaka,
			"vat" => $invVatTaka,
			"discount" => $invDisTaka,
			"payable" => $invPayTaka,
			"usersId" => $usersId::UserId(),
			"date" => $date,
		]);

		for ($x = 0; $x < count($proId); $x++) {
			sales::create([
				"name" => $ProName[$x],
				"quantity" => $ProQty[$x],
				"rate" => $ProRate[$x],
				"total" => $proTotalTaka[$x],
				"usersId" => $usersId::UserId(),
				"invoice_id" => $Invoice->id,
				"date" => $date,
			]);

			$UpPro = product::findOrFail([$proId[$x]]);
			foreach ($UpPro as $UpPro) {
				$UpQty = $UpPro->quantity - $ProQty[$x];
				$UpPro->quantity = $UpQty;
				$UpPro->save();
			}
		}

	}
}
