<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Input;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

use Request;

class CronController extends Controller {
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// parent::__construct();
		// $this->authToken();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		echo "helloworld from CRON";
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