<?php
namespace App\helper;
use Session;

class helper {
	public static function UserId() {
		return Session::get("userId");
	}
}

?>