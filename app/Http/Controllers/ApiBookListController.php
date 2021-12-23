<?php

namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;

class ApiBookListController extends \crocodicstudio\crudbooster\controllers\ApiController
{

	function __construct()
	{
		$this->table       = "bible";
		$this->permalink   = "book_list";
		$this->method_type = "get";
	}


	public function hook_before(&$postdata)
	{
		//This method will be execute before run the main process
		$data = DB::table('bible')
			->orderBy('id')
			->groupBy('book')
			->pluck('book')
			->map(function ($row) {
				return ucwords($row);
			});

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
