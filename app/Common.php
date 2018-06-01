<?php
namespace App;

use Illuminate\Support\Facades\Auth;

class Common {
	static function makeObjectId() {
		$time = time();
		$randNum = rand(0,100000);
		$user_id = Auth::guest() ? '' : Auth::user()->id;

		return base64_encode("{$time}:{$randNum}:{$user_id}");
	}
}