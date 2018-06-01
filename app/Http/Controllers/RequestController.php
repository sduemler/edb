<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
	/**
	 * Show request result page for contributors
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$requests = DB::select("
    	select 
			requests.id,
			requests.type,
			species_id,
			users2.name as proceed_by,
			requests.created_at,
			requests.updated_at,
			requests.proceed_at,
			requests.status
		from requests
		left join users users2 on users2.id = requests.proceed_user_id
		where user_id = ?
    	", [Auth::user()->id]);

		return view('request.index', ['requests' => $requests]);
	}
}
