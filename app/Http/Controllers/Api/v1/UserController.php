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

class UserController extends ApiController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| Api for controller handler created by rusdi on monday 3 september 2018 14:16
	| controller as you wish. It is just here to get your app started!
	|
    */
    public $table = 'ms_user';
    public $primary_key = 'user_id';
    public $list_column = array('user_id', 'site_id', 'parent_user_id', 'level_id','user_code', 'firstname', 'lastname', 'quota_initial', 'quota_additional', 'quota_remaining', 'job_title', 'division', 'email', 'user_category', 'password', 'counter_wrong_pass', 'status_lock', 'locked_time', 'reset_by', 'reset_time',  'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
    public $list_required_column = array('email');
	
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

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function get()
	{
		$attr = NULL;
		if (! empty($_GET)) $attr = $_GET;
			
		// $q = 'SELECT * FROM ' . $this->table . ' WHERE 1';
		$q = '
		SELECT user_id, firstname, lastname, CONCAT(firstname," ",lastname) as fullname, job_title, division, 
		email, user_code, password, user_category, role_name, level_id, level_name, site_id, ur.role_id,
		parent_user_id, quota_initial, quota_additional, quota_remaining, email, password, counter_wrong_pass, 
		status_lock, locked_time, reset_by, reset_time,  u.status, u.created_at, u.created_by, u.created_ip, 
		u.updated_at, u.updated_by, u.updated_ip
		FROM '	. $this->table . ' u
		LEFT JOIN ms_level l USING(level_id)
		LEFT JOIN ms_user_role ur USING(user_id)
		LEFT JOIN ms_role r USING(role_id)
		WHERE 1';
		
		if (isset($attr['user_id']) && $attr['user_id'] != '') 
		{
			$q.= ' AND u.user_id = '.$attr['user_id'];
		}
		
		$data = orm_get($q);
		echo json_encode($data);
		die;
	}
	
	public function get_list()
	{
		$attr = $result = NULL;
		if (! empty($_GET)) $attr = $_GET;
			
		$q = '
		SELECT user_id, firstname, lastname, job_title, division, email, user_category, role_name, level_id, level_name, site_id, ur.role_id, u.status
		FROM '	. $this->table . ' u
		LEFT JOIN ms_level l USING(level_id)
		LEFT JOIN ms_user_role ur USING(user_id)
		LEFT JOIN ms_role r USING(role_id)
		WHERE 1';
		
		if (isset($attr['keyword']) && $attr['keyword'] != '') {
			
			// array('user_id', 'site_id', 'parent_user_id', 'level_id','user_code', 'firstname', 'lastname', 'quota_initial', 'quota_additional', 'quota_remaining', 'job_title', 'division', 'email', 'user_category', 'password', 'counter_wrong_pass', 'status_lock', 'locked_time', 'reset_by', 'reset_time',  'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
			
			$q.= ' AND ( ';
			$q.= ' user_code LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR CONCAT(firstname, " ", lastname) LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR lastname LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR job_title LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR division LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR email LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR user_category LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ')';
        }
		
		if (isset($attr['user_id']) && $attr['user_id'] != '') {
			$q.= ' AND user_id = '.$attr['user_id'];
        }
        
		if (isset($attr['status']) && in_array(array(-1,0,1),$attr['status'])) {
			$q.= ' AND u.status = '.$attr['status'];
        } else {
			$q.= ' AND u.status != -1';
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
	
	public function get_list_dropdown()
	{
		$attr = $result = NULL;
		if (! empty($_GET)) $attr = $_GET;
			
		$q = 'SELECT user_id, CONCAT(firstname," ",lastname) as fullname FROM ' . $this->table . ' WHERE 1';
		
		if (isset($attr['keyword']) && $attr['keyword'] != '') {
			
			// array('user_id', 'site_id', 'parent_user_id', 'level_id','user_code', 'firstname', 'lastname', 'quota_initial', 'quota_additional', 'quota_remaining', 'job_title', 'division', 'email', 'user_category', 'password', 'counter_wrong_pass', 'status_lock', 'locked_time', 'reset_by', 'reset_time',  'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
			
			$q.= ' AND ( ';
			$q.= ' user_code LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR CONCAT(firstname, " ", lastname) LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR lastname LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR job_title LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR division LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR email LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ' OR user_category LIKE '.replace_quote($attr['keyword'],'like');
			$q.= ')';
        }
		
		if (isset($attr['user_id']) && $attr['user_id'] != '') {
			$q.= ' AND user_id = '.$attr['user_id'];
        }
		
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

		$result['data'] = orm_get_list($q);
        
        echo json_encode($result); 
		die;
	}

	public function save()
	{
        $post = $attr = $result = NULL;
		if (! empty($_POST)) $post = $_POST;
		
		// validate_required_column
		$attr_required = validate_required_column($this->list_required_column, $post);

		// validate_column
		$attr = validate_column($this->list_column, $post);

		$result['is_success'] = 1;
		$result['message'] = NULL;
        
        if (empty($attr)) $result['message'] = 'no data';
		if (isset($attr_required)) $result['message'] = $attr_required.' column is required';
		
		// Print error if message exist
		if (isset($result['message'])) {
			$result['is_success'] = 0;
			if (isset($attr)) $result['paramdata'] = $attr;
			echo json_encode($result);
			die;
		}

        if (! empty($attr)) {
            $save = DB::table($this->table)->insert($attr);
            
            if ($save) {
                $result['last_insert_id'] = DB::getPdo()->lastInsertId();
				$result['is_success'] = 1;
                $result['message'] = 'save success';
            } else {
				$result['is_success'] = 0;
                $result['message'] = 'save failed';
            }
        }

        echo json_encode($result);
        die;
	}
	
	public function update()
	{
		$put = $attr = $result = NULL;

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') parse_str(file_get_contents("php://input"), $_PUT);

        $put = $_PUT;
		
		$attr = validate_column($this->list_column, $put);
		
		$result['is_success'] = 1;
		$result['message'] = NULL;
        
        if (empty($attr)) $result['message'] = 'no data';
        
		if (! isset($attr[$this->primary_key])) $result['message'] = $this->primary_key . ' must be filled.';
		
		// Print error if message exist
		if (isset($result['message'])) {
			$result['is_success'] = 0;
			if (isset($attr)) $result['paramdata'] = $attr;
			echo json_encode($result);
			die;
		}

		/************ Start operation ************/
		$param_where = $attr[$this->primary_key];
		unset($attr[$this->primary_key]);

		$update = DB::table($this->table)
			->where($this->primary_key, $param_where)
			->update($attr);
			
		if ($update) {
			$result['is_success'] = 1;
			$result['message'] = 'update success';
		} else {
			$result['is_success'] = 0;
			$result['message'] = 'update failed';
			// $result['query'] = $update->toSql();
		}

        echo json_encode($result);
        die;
	}
	
	public function delete()
	{
		$delete = $attr = $result = NULL;

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') parse_str(file_get_contents("php://input"), $_DELETE);

        $delete = $_DELETE;
		
		$attr = validate_column($this->list_column, $delete);
		
		$result['is_success'] = 1;
		$result['message'] = NULL;
        
        if (empty($attr)) $result['message'] = 'no data';
        
		if (! isset($attr[$this->primary_key])) $result['message'] = $this->primary_key . ' must be filled.';
		
		// Print error if message exist
		if (isset($result['message'])) {
			$result['is_success'] = 0;
			if (isset($attr)) $result['paramdata'] = $attr;
			echo json_encode($result);
			die;
		}

		/************ Start operation ************/
		$param_where = $attr[$this->primary_key];
		// unset($attr[$this->primary_key]);
		$attr['status'] = '-1';

		$update = DB::table($this->table)
			->where($this->primary_key, $param_where)
			->update($attr);
			
		if ($update) {
			$result['is_success'] = 1;
			$result['message'] = 'delete success';
		} else {
			$result['is_success'] = 0;
			$result['message'] = 'delete failed';
			// $result['query'] = $update->toSql();
		}

        echo json_encode($result);
        die;
	}
	
	public function __destruct()
	{
		// parent::__construct();
	}
	
}