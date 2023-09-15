<?php

namespace App\Http\Controllers\usersController;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\invoice;
use App\Models\Users\user;
use Illuminate\Http\Request;

class reportController extends Controller {
	function reportPage() {
		$userId = new helper();
		if ($userId::UserId()) {
			$userData = user::findOrFail($userId::UserId());
			return view("users.report", compact("userData"));
		}
	}

	function reportGena(Request $request) {
		$userId = new helper();
		$fromDate = $request->fromData;
		$toDate = $request->toDate;

		$date = $fromDate . ' To ' . $toDate;
		$ReportTotal = invoice::where("usersId", $userId::UserId())->whereBetween("date", [$fromDate, $toDate])->sum('total');
		$ReDiscount = invoice::where("usersId", $userId::UserId())->whereBetween("date", [$fromDate, $toDate])->sum('discount');
		$ReportVat = invoice::where("usersId", $userId::UserId())->whereBetween("date", [$fromDate, $toDate])->sum('vat');
		$RepPayable = invoice::where("usersId", $userId::UserId())->whereBetween("date", [$fromDate, $toDate])->sum('payable');
		$reportDetails = invoice::where("usersId", $userId::UserId())->whereBetween("date", [$fromDate, $toDate])->get();

		return compact("date", "ReportTotal", "ReDiscount", "ReportVat", "RepPayable", "reportDetails");

	}
}
