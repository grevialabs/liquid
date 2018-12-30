<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Input;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

use Request;

class ApiController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| Api for controller handler created by rusdi on monday 3 september 2018 14:16
	| controller as you wish. It is just here to get your app started!
	|
	*/
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// parent::__construct();
		
		// $this->middleware('guest');
		$this->authToken();
		// echo "yamete blokir";
		// die;
	}

	public function authToken() 
	{
		$is_valid = FALSE;
		$header = $secretkey = NULL;

		if (Request::header('secretkey')) {
			$secretkey = Request::header('secretkey');
		}

		if (isset($_GET['secretkey'])) {
			$secretkey = $_GET['secretkey'];
		}
		
		if (isset($_POST['secretkey'])) {
			$secretkey = $_POST['secretkey'];
		}

		if ($secretkey) {
			$header = Request::header();
			// $secretkey = Request::header('secretkey');

			// Check secretkey exist and valid
			$q = 'SELECT * FROM scr_token WHERE token = "'.$secretkey.'"';
			$check = orm_get($q);

			// debug($check,1);
			// debug('<hr/>tutup',1);
			
			// Check token registered and not expired then valid 
			if ($check) {
				$is_valid = TRUE;
			}
		} else {
			$message['message'] = ERROR_SECRETKEY_INVALID;
		}

		// debug('gokil',1);
		if (! $is_valid) {

			echo json_encode($message);
			die;
		}
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		echo "helloworld from API";
		die;
	}
		
	// public function log()
	// {
		// echo "helloworld logdata from API";
		// die;
	// }
	
	// public function log()
	// {
		// echo "helloworld logdata from API";
		// die;
	// }
	
	// public function log()
	// {
		// echo "helloworld logdata from API";
		// die;
	// }
	
}