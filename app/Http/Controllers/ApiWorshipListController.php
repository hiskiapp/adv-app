<?php

namespace App\Http\Controllers;

use Session;
use Request;
use Illuminate\Support\Facades\DB;
use CRUDBooster;

class ApiWorshipListController extends \crocodicstudio\crudbooster\controllers\ApiController
{

	function __construct()
	{
		$this->table       = "worships";
		$this->permalink   = "worship_list";
		$this->method_type = "get";
	}


	public function hook_before(&$postdata)
	{
		//This method will be execute before run the main process
		$data = DB::table('worships')
			->when($postdata['date'], function ($q) use ($postdata) {
				return $q->whereDate('datetime', $postdata['date']);
			})
			->orderBy('datetime', 'desc')
			->paginate();

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
