<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Species extends Model
{
	protected $guarded = [];

	static function createWithCurrentUser($data) {
		$data['user_id'] = Auth::user()->id;
		$data['oid'] = Common::makeObjectId();

		if(Auth::user()->role->id == 3) {
			$data['is_approved'] = 0;
		}

		$species = Species::create($data);

		if(Auth::user()->role->id == 3) {
			Request::create([
				'user_id' => $data['user_id'],
				'species_id' => $species->id,
				'type' => 'create',
			]);
		}

		return $species->id;
	}

	static function updateWithCurrentUser($id, $data) {
		unset($data['_method']);
		$data['user_id'] = Auth::user()->id;
		$data['oid'] = Species::find($id)->oid;
		$data['version'] = Species::where('oid', Species::find($id)->oid)->select('version')->max('version') + 1;

		if(Auth::user()->role->id == 3) {
			$data['is_approved'] = 0;
		}

		$species = Species::create($data);

		if(Auth::user()->role->id == 3) {
			Request::create([
				'user_id' => $data['user_id'],
				'species_id' => $species->id,
				'type' => 'update',
			]);
		}

		return $species->id;
	}
}
