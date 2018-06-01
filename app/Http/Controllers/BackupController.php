<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
	/**
	 * Display page for backup.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$monitor = [];
		Artisan::call('backup:monitor');
		$monitor['status'] = Artisan::output();
		Artisan::call('backup:list');
		$list = Artisan::output();
		$list = $this->createListArr($list);

		$monitor['isHealth'] = true;
		if(strpos(strtolower($monitor['status']), 'fail') || strpos(strtolower($monitor['status']), 'unhealth')) {
			$monitor['isHealth'] = false;
		}

		$filePath = Storage::files($list['Name']);
		$files = [];
		foreach ($filePath as $index => $path) {
			$timeStr = substr($path, strpos($path, '/') + 1, strpos($path, '.zip') - strpos($path, '/') - 1);
			$timeArr = explode("-", $timeStr);
			$files[$path] = [
				'fullPath' => base_path("storage/app/{$path}"),
				'datetime' => "{$timeArr[1]}/{$timeArr[2]}/{$timeArr[0]} {$timeArr[3]}:{$timeArr[4]}:{$timeArr[5]}",
				'index' => $index
			];
		}

		return view('backup.index', ['monitor' => $monitor, 'list' => $list, 'files' => $files]);
	}

	private function createListArr($list) {
		$rows = preg_split('/[\n]/', $list);
		$headers = $rows[1];
		$data = $rows[3];

		$headerArr = explode("|", $headers);
		$dataArr = explode("|", $data);

		$rtn = [];

		foreach($headerArr as $key => $header) {
			if($key == 0) continue;
			$rtn[trim($header)] = trim($dataArr[$key]);
		}

		return $rtn;
	}

	/**
	 * Create new backup file.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		Artisan::call('backup:run');
		return redirect(route('backup.index'));
	}

	/**
	 * Clean up old backup files depend on rules.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request) {
		$path = $request->all()['path'];
		Storage::delete($path);
		return redirect(route('backup.index'));
	}
}
