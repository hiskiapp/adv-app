<?php

namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;

class ApiReflectionListController extends \crocodicstudio\crudbooster\controllers\ApiController
{

	function __construct()
	{
		$this->table       = "reflections";
		$this->permalink   = "reflection_list";
		$this->method_type = "get";
	}


	public function hook_before(&$postdata)
	{
		//This method will be execute before run the main process
		$data = DB::table('reflections')
			->join('cms_users', 'reflections.cms_users_id', '=', 'cms_users.id')
			->select(
				'reflections.id',
				'reflections.date',
				'cms_users.name as speaker',
				'reflections.title',
				'reflections.content',
				'reflections.audio'
			)
			->when($postdata['date'], function ($q) use ($postdata) {
				return $q->whereDate('reflections.date', $postdata['date']);
			})
			->orderBy('date', 'desc')
			->paginate();

		foreach ($data as $row) {
			$row->audio = is_null($row->audio) ? null : url($row->audio);
		}

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
