<?php

namespace App\Http\Controllers\usersController;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\invoice;
use App\Models\Users\sales;
use App\Models\Users\user;
use Illuminate\Http\Request;

class invoiceController extends Controller {
	function invoicePage() {
		$userId = new helper();
		if ($userId::UserId()) {

			$userData = user::findOrFail($userId::UserId());
			return view("users.invoice", compact("userData"));
		}
	}
	function InvoiceAll() {
		$userId = new helper();
		$invoiceData = invoice::where("usersId", $userId->userId())->get();
		return $invoiceData;
	}
	function InvoiceViewShow(Request $request) {
		$userId = new helper();

		$invoiceView = invoice::where("id", $request->viewId)->where("usersId", $userId::UserId())->first();
		$salesView = sales::where("usersId", $userId::UserId())->where("invoice_id", $request->viewId)->get();
		return compact("invoiceView", "salesView");
	}
	function invoiceDelete(Request $request) {
		$userId = new helper();

		invoice::where("id", $request->InvDelId)->where("usersId", $userId::UserId())->delete();
		sales::where("invoice_id", $request->InvDelId)->where("usersId", $userId::UserId())->delete();

	}
}
