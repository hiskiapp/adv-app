<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;

		class ApiSionSongDetailController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "sion";        
				$this->permalink   = "sion_song_detail";    
				$this->method_type = "get";    
		    }
		

		    public function hook_before(&$postdata) {
		        //This method will be execute before run the main process
				$data = DB::table('sion')
					->where('number', $postdata['number'])
					->first();
				
				if ($data) {
					$response = [
						'api_status' => 1,
						'api_message' => 'success',
						'data' => $data
					];
				}else{
					$response = [
						'api_status' => 0,
						'api_message' => 'Lagu sion tidak ditemukan',
					];
				}

				response()->json($response)->send();
				exit;
		    }

		    public function hook_query(&$query) {
		        //This method is to customize the sql query

		    }

		    public function hook_after($postdata,&$result) {
		        //This method will be execute after run the main process

		    }

		}