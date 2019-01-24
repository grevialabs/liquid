<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Input;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Http\Request;

use Request;
use DB;

// namespace App;

use App\Models\CompanyModel;

class CompanyController extends ApiController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| Api for controller handler created by rusdi on monday 3 september 2018 14:16
	| controller as you wish. It is just here to get your app started!
	|
    */
    public $table = 'ms_company';
    public $primary_key = 'company_id';
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{		
		// $this->middleware('guest');

		// auth from apicontroller
		parent::__construct();

	}

	// with eloqueen
	public function get_list_status()
	{
		// $log = ArticleModel::all();
		// $log = ArticleModel::where('company_id',3)
		// $log = ArticleModel::whereName('mantap')
		$log = ArticleModel::whereStatus('1')
						->get()
						->all();
						// ->toSql()->get();
		// $data = 

						// $log = $logModel->toSql();
		echo json_encode($log);

		// $log = $this->sql_debug($log);
		// debug($log);
		die;
		// debug($log);
		// debug('mantap from model<hr/>');
		// debug($log,1);
		// echo $log->
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function get()
	{
		$attr = NULL;
		if (! empty($_GET)) $attr = $_GET;
			
		$q = 'SELECT * FROM ' . $this->table . ' WHERE 1';
		
		if (isset($attr['company_id']) && $attr['company_id'] != '') 
		{
			$q.= ' AND company_id = '.$attr['company_id'];
		}
		
		$data = orm_get($q,NULL,'json');
		debug($data);
		die;
	}
	
	public function get_list()
	{
		
		// dd($response->headers); 
		// $header = $secretkey = NULL;
		// if (Request::header('secretkey')) {
		// 	$header = Request::header();
		// 	$secretkey = Request::header('secretkey');
		// }

		$attr = $result = NULL;
		if (! empty($_GET)) $attr = $_GET;
			
		$q = 'SELECT * FROM ' . $this->table . ' WHERE 1';
		
		if (isset($attr['keyword']) && $attr['keyword'] != '') {
			$q.= ' AND company_name LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' AND company_name LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' AND company_name LIKE '.replace_quote($attr['keyword'],'like');
        }
		
		if (isset($attr['company_id']) && $attr['company_id'] != '') {
			$q.= ' AND company_id = '.$attr['company_id'];
        }
        
        $result['total_rows'] = count(orm_get_list($q));
		
		if (isset($attr['order'])) { 
			$q.= ' ORDER BY ' . $attr['order'];
		} else  {
			$q.= ' ORDER BY company_id DESC ';
		}
		
		// set default paging
		if (! isset($attr['paging'])) {
			if (! isset($attr['offset'])) $attr['offset'] = OFFSET;
			if (! isset($attr['perpage'])) $attr['perpage'] = PERPAGE;
		}
		
		if (isset($attr['offset'])) { 
			$q.= ' LIMIT ' . $attr['offset'];
			
			if (! isset($attr['perpage'])) $attr['perpage'] = PERPAGE;
			
			$q.= ', ' . $attr['perpage'];
		}

		$data = orm_get_list($q);
        $result['data'] = $data;
        
        echo json_encode($result); 
		die;
		
	}

	public function save()
	{
        $attr = $result = NULL;
		if (! empty($_POST)) $attr = $_POST;
        
        if (! empty($attr)) 
        {
            $save = DB::table($this->table)->insert($attr);
            
            if ($save) {
                $result['last_insert_id'] = DB::getPdo()->lastInsertId();
				$result['is_success'] = 1;
                $result['message'] = 'success';
            } else {
                // $result['
				$result['is_success'] = 0;
                $result['message'] = 'failed';
            }
        }

        echo json_encode($result);
        die;
		
	}
	
	public function update()
	{
		$attr = $result = NULL;
        // if (! empty($_PUT)) $attr = $_PUT;

        if ($_SERVER['REQUEST_METHOD'] == 'PUT')
        {
            parse_str(file_get_contents("php://input"), $_PUT);
        }

        $attr = $_PUT;
        
        if (! empty($attr)) 
        {
            if (! isset($this->primary_key)) debug($this->primary_key . ' must be filled.');

            $param_where = $attr[$this->primary_key];
            // unset($attr[$this->primary_key]);

            
            // DB::enableQueryLog();

            $update = DB::table($this->table)
                ->where($this->primary_key, $param_where)
                ->update($attr);
				
            if ($update) {
                $result['is_success'] = 1;
                $result['message'] = 'update success';
                $result['debug'] = DB::getQueryLog();
            } else {
                $result['is_success'] = 0;
                $result['message'] = 'update failed';
                $result['debug'] = DB::getQueryLog();
                // $result['query'] = $update->toSql();
            }
        }

        // echo json_encode($result);
        debug($result);
        die;
	}
	
	public function delete()
	{
		echo "hello delete log";
		die;
	}
	
	public function __destruct()
	{
		// parent::__construct();
	}
	
}