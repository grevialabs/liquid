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

	// Reset quota by user
	public function reset_quota_by_days()
	{
		// When reset days exceeded then reset quota each user
		// - table user: initial_quota will be restore by top_down / bottom_up

		echo "helloworld logdata from API";
		die;
	}

	// Reset quota by user
	public function update_quota_additional()
	{
		// When user wants to add new quota for their child, user will edit quota in menu user
		// user targeted will be increment value(quota/value) 
		echo "helloworld logdata from API";
		die;
	}
	
	public function send_csv_poblanket_to_oms()
	{
		echo "helloworld logdata from API";
		die;
	}

	public function send_csv_order_to_magento()
	{
		echo "helloworld logdata from API";
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