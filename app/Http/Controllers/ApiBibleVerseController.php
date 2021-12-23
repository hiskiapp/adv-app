<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;

		class ApiBibleVerseController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "bible";        
				$this->permalink   = "bible_verse";    
				$this->method_type = "get";    
		    }
		

		    public function hook_before(&$postdata) {
		        //This method will be execute before run the main process
				$data = DB::table('bible')
					->where('book', $postdata['book'])
					->where('chapter', $postdata['chapter'])
					->where('verse', $postdata['verse'])
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
						'api_message' => 'Ayat tidak ditemukan',
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