<?php

namespace App\Http\Controllers;

use App\Species;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the species records which are needed to approve.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$requests = DB::select("
    	select 
			requests.id,
			users1.name as requested_by,
			requests.type,
			species_id,
			species_name,
			users2.name as proceed_by,
			requests.created_at,
			requests.updated_at,
			requests.proceed_at,
			requests.status
		from requests
		join species on species_id = species.id
		join users users1 on users1.id = requests.user_id
		left join users users2 on users2.id = requests.proceed_user_id
    	");

		return view('species.approval', ['requests' => $requests]);
    }

    /**
     * Approve a specified species record
     *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
		\App\Request::findOrFail($id)->update([
			'status' => 'Approved',
			'proceed_at' => Carbon::now(),
			'proceed_user_id' => Auth::user()->id,
		]);

		Species::find(\App\Request::find($id)->species_id)->update(['is_approved' => 1]);

		return redirect(route('species.approval'));
    }

	/**
	 * Deny a specified species record
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function deny(Request $request, $id)
	{
		\App\Request::find($id)->update([
			'status' => 'Denied',
			'proceed_at' => Carbon::now(),
			'proceed_user_id' => Auth::user()->id,
		]);

		Species::find(\App\Request::find($id)->species_id)->update(['is_approved' => 0]);

		return redirect(route('species.approval'));
	}
}
