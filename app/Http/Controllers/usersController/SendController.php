<?php

namespace App\Http\Controllers\usersController;

use App\Http\Controllers\Controller;
use App\Mail\users\sendMail;
use App\Models\Users\sendOtp;
use App\Models\Users\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SendController extends Controller {
	function userSendOtp(Request $request) {
		if (!($request->isMethod("post"))) {
			return view("frontend.users.sendOtp");
		} else {
			$sendMail = $request->SendEmail;
			$user = user::where("email", $sendMail)->first();
			if (isset($user)) {
				$randNum = rand(2000, 8000);
				$forget = sendOtp::create([
					"token" => $randNum,
					"user_id" => $user->id,
				]);
				Mail::to($user->email)->send(new sendMail($forget));
				return response()->json([
					"status" => 200,
					"success" => "OTP Send Success",
				]);
			} else {
				return response()->json([
					"status" => 200,
					"faild" => "Email Does Not Match",
				]);
			}
		}
	}
	function verifyOtp(Request $request) {
		if ($request->isMethod("post")) {
			$data = $request->validate(
				[
					'VerifyOtp' => "required",
				],
				[
					"VerifyOtp.required" => "Please Otp Number",
				]
			);
			$verifyOtp = $data["VerifyOtp"];
			$sendOtp = sendOtp::where("token", $verifyOtp)->first();

			if (isset($sendOtp)) {
				return view("frontend.users.resetPassword", compact("sendOtp"));
			} else {
				return back()->with("faild", "Incorrect Otp");
			}

		} else {
			return view("frontend.users/verifyOtp");
		}

	}
	function passReset(Request $request) {
		if ($request->isMethod('post')) {
			$otp = $request->otp;
			$userOtp = sendOtp::where("token", $otp)->first();
			if (isset($userOtp)) {
				$newPass = Hash::make($request->newPass, ['rounds' => 10]);
				$userOtp->user->password = $newPass;
				$userOtp->user->update();
				return response()->json([
					"status" => 200,
					"success" => $userOtp->delete(),
				]);
			} else {
				return response()->json([
					"status" => 200,
					"faild" => "Request Faild",
				]);
			}

		} else {
			return view("frontend.users.resetPassword");
		}

	}
}
