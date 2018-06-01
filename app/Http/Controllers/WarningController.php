<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class WarningController extends Controller
{
	/**
	 * Display warning box and let user to make choice
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$arr = json_decode($request->all()['data'], true);

		$reason = $arr['reason'];
		$data = $arr['data'];

		$view = "warning.{$reason}";

		if(View::exists($view)) {
			return view($view, ['data' => $data]);
		} else {
			return redirect('/');
		}
	}
}
