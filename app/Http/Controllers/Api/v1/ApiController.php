<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Input;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

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