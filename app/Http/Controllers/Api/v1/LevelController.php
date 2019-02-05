<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use Input;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Http\Request;

// use Request;
use DB;

use App\Models\CompanyModel;

class LevelController extends ApiController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| Api for controller handler created by rusdi on monday 3 september 2018 14:16
	| controller as you wish. It is just here to get your app started!
	|
    */
    public $table = 'ms_level';
    public $primary_key = 'level_id';
    public $list_column = array('', 'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
	
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

		die;
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
		
		$data = orm_get($q);
		echo json_encode($data);
		die;
	}
	
	public function get_list()
	{
		$attr = $result = NULL;
		if (! empty($_GET)) $attr = $_GET;
			
		$q = 'SELECT * FROM ' . $this->table . ' WHERE 1';
		
		if (isset($attr['keyword']) && $attr['keyword'] != '') {
			$q.= ' AND ( ';
			$q.= ' company_name LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR company_address LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR company_phone LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR company_pic LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ')';
        }
		
		if (isset($attr['company_id']) && $attr['company_id'] != '') {
			$q.= ' AND company_id = '.$attr['company_id'];
        }
        
        $result['total_rows'] = count(orm_get_list($q));
		
		if (isset($attr['order'])) { 
			$q.= ' ORDER BY ' . $attr['order'];
			if (isset($attr['orderby'])) $q .= ' '.$attr['orderby']; 
		} else  {
			$q.= ' ORDER BY '. $this->primary_key .' DESC';
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
        $post = $attr = $result = NULL;
		if (! empty($_POST)) $post = $_POST;
		
		// validate_column
		$attr = validate_column($this->list_column, $post);
        
        if (! empty($attr)) {
            $save = DB::table($this->table)->insert($attr);
            
            if ($save) {
                $result['last_insert_id'] = DB::getPdo()->lastInsertId();
				$result['is_success'] = 1;
                $result['message'] = 'success';
            } else {
				$result['is_success'] = 0;
                $result['message'] = 'failed';
            }
        }

        echo json_encode($result);
        die;
	}
	
	public function update()
	{
		$put = $attr = $result = NULL;
        // if (! empty($_PUT)) $attr = $_PUT;

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents("php://input"), $_PUT);
        }

        $put = $_PUT;
		
		// validate_column
		$attr = validate_column($this->list_column, $put);
		
		$result['is_success'] = 0;
        $result['message'] = 'no data';
        
        if (! empty($attr)) 
        {
            if (! isset($attr[$this->primary_key])) {
				$result['message'] = $this->primary_key . ' must be filled.';
			}
			
			// Print error if exist
			if ($result['is_success']) {
				echo json_encode($result);
				die;
			}

            $param_where = $attr[$this->primary_key];
            unset($attr[$this->primary_key]);

            $update = DB::table($this->table)
                ->where($this->primary_key, $param_where)
                ->update($attr);
				
            if ($update) {
                $result['is_success'] = 1;
                $result['message'] = 'update success';
                // $result['debug'] = DB::getQueryLog();
            } else {
                $result['is_success'] = 0;
                $result['message'] = 'update failed';
                // $result['debug'] = DB::getQueryLog();
                // $result['query'] = $update->toSql();
            }
        }

        echo json_encode($result);
        die;
	}
	
	public function delete()
	{
		$attr = $result = NULL;
        // if (! empty($_PUT)) $attr = $_PUT;

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            parse_str(file_get_contents("php://input"), $_DELETE);
        }

        $attr = $_DELETE;
		
		$result['is_success'] = 0;
        $result['message'] = 'no data';
        
        if (! empty($attr)) 
        {
            if (! isset($attr[$this->primary_key])) {
				$result['message'] = $this->primary_key . ' must be filled.';
			}
			
			// Print error if exist
			if ($result['is_success']) {
				echo json_encode($result);
				die;
			}

            $param_where = $attr[$this->primary_key];
            unset($attr[$this->primary_key]);

            $update = DB::table($this->table)
                ->where($this->primary_key, $param_where)
                ->update($attr);
				
            if ($update) {
                $result['is_success'] = 1;
                $result['message'] = 'delete success';
                // $result['debug'] = DB::getQueryLog();
            } else {
                $result['is_success'] = 0;
                $result['message'] = 'delete failed';
                // $result['debug'] = DB::getQueryLog();
                // $result['query'] = $update->toSql();
            }
        }

        echo json_encode($result);
        die;
	}
	
	public function __destruct()
	{
		// parent::__construct();
	}
	
}