<?php

namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;

class ApiSionSongListController extends \crocodicstudio\crudbooster\controllers\ApiController
{

	function __construct()
	{
		$this->table       = "sion";
		$this->permalink   = "sion_song_list";
		$this->method_type = "get";
	}


	public function hook_before(&$postdata)
	{
		//This method will be execute before run the main process
		$data = DB::table('sion')
			->when($postdata['filter'], function ($q) use ($postdata) {
				return $q->where('number', 'LIKE', "%{$postdata['filter']}%")
					->orWhere('title', 'LIKE', "%{$postdata['filter']}%");
			})
			->select('id', 'number', 'title')
			->get();

		$response = [
			'api_status' => 1,
			'api_message' => 'success',
			'data' => $data
		];

		response()->json($response)->send();
		exit;
	}

	public function hook_query(&$query)
	{
		//This method is to customize the sql query

	}

	public function hook_after($postdata, &$result)
	{
		//This method will be execute after run the main process

	}
}
