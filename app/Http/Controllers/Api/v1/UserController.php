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
    public $list_column = array('user_id', 'site_id', 'parent_user_id', 'level_id','user_code', 'firstname', 'lastname', 'quota_initial', 'quota_additional', 'quota_remaining', 'job_title', 'division','article_attribute_reason','attribute_value', 'email', 'user_category', 'password', 'counter_wrong_pass', 'status_lock', 'locked_time', 'reset_by', 'reset_time', 'reset_token', 'reset_token_expired', 'status', 'created_at', 'created_by','created_ip','updated_at','updated_by','updated_ip');
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
		email, user_code, `password`, user_category, role_name, level_id, level_name, site_id, ur.role_id,
		parent_user_id, quota_initial, quota_additional, quota_remaining, email, counter_wrong_pass, 
		status_lock, locked_time, reset_by, reset_time, reset_token, reset_token_expired, u.status, u.created_at, u.created_by, u.created_ip, 
		u.updated_at, u.updated_by, u.updated_ip
		FROM '	. $this->table . ' u
		LEFT JOIN ms_level l USING(level_id)
		LEFT JOIN ms_user_role ur USING(user_id)
		LEFT JOIN ms_role r USING(role_id)
		WHERE 1';
		
		if (isset($attr['user_id']) && $attr['user_id'] != '') {
			$q.= ' AND u.user_id = '.$attr['user_id'];
		}

		if (isset($attr['user_code']) && $attr['user_code'] != '') {
			$q.= ' AND u.user_code = '.replace_quote($attr['user_code']);
		}

		if (isset($attr['email']) && $attr['email'] != '') {
			$q.= ' AND u.email = '.replace_quote($attr['email']);
		}

		// debug($q,1);
		
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
		
		if (isset($attr['user_code']) && $attr['user_code'] != '') {
			$q.= ' AND u.user_code = '.replace_quote($attr['user_code']);
		}

		if (isset($attr['email']) && $attr['email'] != '') {
			$q.= ' AND u.email = '.replace_quote($attr['email']);
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

	// TOPDOWN QC : DONE by rusdi thursday 21 mar 2019
	// BOTTOM UP QC : not yet
	public function insert_quota_by_site_id()
	{
		$error = $return = $attr = NULL;
		if (! empty($_GET)) $attr = $_GET;
		
		if (! $attr['site_id']) $error = 'Site_id harus diisi';

		if ($error) {
			$return['error'] = $error;
			echo json_encode($return);
			die;
		}

		$q = 'SELECT * FROM ms_site s WHERE s.site_id = ' . replace_quote($attr['site_id']);
		$obj_site = orm_get($q,NULL,'json');
		$obj_site = json_decode($obj_site,1);

		$flag_qty_value = $site_qty_value = $list_user = NULL;
		$return['data'] = NULL;
		if (isset($obj_site['site_id'])) 
		{

			$flag_qty_value = $obj_site['flag_qty_value']; // qty
			$site_qty_value = $obj_site['site_qty_value']; // 200


			// Detect type method_calc
			if ($obj_site['method_calc'] == 'top_down') 
			{
				
				// Start top_down logic
				$list_user = $this->get_list_parent_by_user(array(
					'site_id' => $obj_site['site_id'],
					'flag_qty_value' => $obj_site['flag_qty_value'],
					'site_qty_value' => $obj_site['site_qty_value'],
				));
				$list_user = json_decode($list_user,1);
				// debug($list_user,1);

				// Load all user and check level structure
				if (! empty($list_user)) {
					foreach ($list_user as $ky => $rs) {
						// Check if
						// $this->($site_qty_value);
						// debug($rs);
					}
				}

				$return['data'] = $list_user;
				// debug($list_user);
				// die;

				// End top_down logic

			} 
			else if ($obj_site['method_calc'] == 'bottom_up') 
			{
				
				// Start bottom_up logic

				// End bottom_up logic

			}
		}
		else
		{
			$return['message'] = 'data not found / error occurred';
		}

		// $list_user = $this->sortme($list_user);
		debug($return,1);
		// echo json_encode($return);
		die;
		// debug($list_user,1);
		
		
		// debug($list_user,1);
	}

	// get child by 
	// private function sortme($data)
	// {
	// 	$result = $resultnew = NULL;
	// 	foreach ($data as $key => $rs )
	// 	{
	// 		// echo "koflak".HR;
	// 		// debug($rs['listchild'],1);
	// 		// $result[] = $this->filldata($rs);
	// 		if ($rs['totalchild'] > 0) {
	// 			echo "kenanih " . $key.HR;
	// 			// debug($rs['listchild'][0]);
	// 			// echo "kenanihaa ".HR;
	// 			if (is_array($rs['listchild'])) {
	// 				// $temparr
	// 				$result['ancur'][] = $this->sortme($rs['listchild']);
	// 				debug('1tutupnih');
	// 			} 

	// 			if (is_array($rs['listchild'][0])) {
	// 				$resultnew['ancurlagi'][] = $this->sortme($rs['listchild'][0]);
	// 				debug('2tutupnih');
	// 			}
	// 			// debug($resultnew.HR);
	// 			// debug('jalangasih'.HR);
	// 			// $resultnew[] = $rs['listchild'][0];
	// 			// echo "inilah listchild" . $key . HR;
	// 			// debug($result,1);
	// 		// } else if ($rs['totalchild'][0] > 0) {
	// 			// $resultnew[] = $this->sortme($rs['listchild'][0]);
	// 		} else {
	// 			$result[] = $this->filldata($rs);
	// 			$result[] = $this->filldata($resultnew);

	// 		}

	// 	}
	// 	return $result;
	// 	// return $resultnew;
	// 	// debug($result);
	// 	// debug($resultnew);
	// 	// echo "habislah sudah";
	// 	// die;

	// }

	// private function filldata($data)
	// {
	// 	$result = NULL;
	// 	if (!empty($data)){
	// 		if (isset($data['user_id'])) $result['user_id'] = $data['user_id'];
	// 		if (isset($data['user_code'])) $result['user_code'] = $data['user_code'];
	// 	}
	// 	return $result;
	// }

	// private function sort_list_user(&$out,$key,$data)
	// {
	// 	if (empty($data)) return 'error data harus diisi';

	// 	$temp = $tempos = NULL;
	// 	if (is_array($data)) {
	// 		foreach ($data as $ky => $rs) {

	// 			$temp = array();
				
	// 			// $temp = $rs;
	// 			// if ($rs['totalchild'] >= 1) {
	// 			if (is_array($rs['totalchild'])) {
					
	// 				$this->sort_list_user_by_userorder($out,$key.$ky.'_',$rs['listchild']);
					
	// 			} else {
					
	// 				// $temp = $rs;
	// 				$out[$key.'_'.$ky] = $rs;
					
	// 			}

	// 		}
	// 	}
	// 	// return $tempos;

	// }

	// get child by 
	// private function sort_list_user_by_userorder(&$out,$key,$data)
	// {
	// 	if (empty($data)) return 'error data harus diisi';

	// 	$temp = $tempos = NULL;
	// 	if (is_array($data)) {
	// 		// debug('fayah'.HR);
	// 		// debug($data,1);
	// 		foreach ($data as $ky => $rs) {

	// 			// $tempos = array();
	// 			$temp = array();
				
	// 			// $temp = $rs;
	// 			// if ($rs['totalchild'] >= 1) {
	// 			if (is_array($rs['totalchild'])) {
	// 				// return $tempos;
	// 				// debug($rs,1);
					
	// 				$this->sort_list_user_by_userorder($out,$key.$ky.'_',$rs['listchild']);

	// 				// foreach ($temp as $tmpv) {
	// 					// isi()
	// 				// }
					
	// 			} else {
					
	// 				// $temp = $rs;
	// 				$out[$key.'_'.$ky] = $rs;
	// 				// $arr[]
	// 				// $temp['quota'] = $rs['quota'];
	// 				// debug($rs);
					
	// 			}
	// 			// $tempos[] = $temp;
	// 		}
	// 	}
	// 	// return $tempos;

	// }

	// private function sort_list($arr) {
	// 	$out = array();
	// 	$this->sort_list_user_by_userorder($out,'',$arr);
	// 	return $out;
	//   }
	
	// ================================================================================
	// Mode Topdown - Return all user with quota - using recursive method
	// QC : checked by rusdi - thursday 21 mar 2019
	private function get_list_parent_by_user($attr = NULL)
	{
		$result = $error = $quota = NULL;
		$userorder = 1; // user hierarchy
        // if (! empty($_GET)) $attr = $_GET;
		// if (! empty($attr)) $attr = $_GET;
		
		// debug($attr);
		
		if (! isset($attr['site_id'])) $error = 'Site_id harus diisi';
		if (! isset($attr['flag_qty_value'])) $error = 'flag_qty_value harus diisi';
		if (! isset($attr['site_qty_value'])) $error = 'site_qty_value harus diisi';
		
		if ($error) {
			$return['error'] = $error;
			echo json_encode($return);
			die;
		}

		$quota = $attr['site_qty_value'];

        // Get all parent with child
        $q = '
		SELECT user_id,user_code, l.level_name, l.level_hierarchy, ' . $userorder . ' as userorder, u.parent_user_id, 
        (
            SELECT COUNT(user_id)
            FROM ms_user mu 
            WHERE mu.parent_user_id = u.user_id
        ) as totalchild
        FROM ms_user u 
        LEFT JOIN ms_level l USING (level_id)
        WHERE 1 AND u.parent_user_id IS NULL AND site_id = ' . replace_quote($attr['site_id']) . '
        HAVING totalchild >= 0
        ';

        $data = orm_get_list($q,'json');
        $data = json_decode($data,1);
        // debug($data,1);

        $result = array();
        if (! empty($data)) {
			$tmpquota = $total_person = 0;
			$total_person = count($data);
			
            foreach ($data as $key => $rs) {
				
				// Count quota here
				$tmpquota = $quota / $total_person;
				if (strpos($tmpquota,'.')) {
					
					// round up on last round
					if ($key == ($total_person - 1)) {
						$tmpquota = ceil($tmpquota);
					} else {
						$tmpquota = floor($tmpquota);
					}
				} 

				$result[$key] = $rs;
				
				// identifier top global parent
				$result[$key]['is_top_parent'] = TRUE;
				$result[$key]['quota'] = $tmpquota;

				// update quota to user
				$save = DB::table($this->table)->where($this->primary_key,$rs['user_id'])->update(array('quota_remaining' => $tmpquota));

                $listchild = NULL;
                $listchild = $this->get_list_child($rs['user_id'], $tmpquota, ($userorder + 1));
				$result[$key]['listchild'] = $listchild;
				
				// $userorder++;
            }
        } else {
			$result['message'] = 'data not found / error occurred';
		}
        
        return json_encode($result); 
		die;
    }
    
	// Recursive function get all child below level
	// userorder = user hierarchy level
    private function get_list_child($user_id, $quota, $userorder)
    {
        $return = $listchild = NULL;

        if (! isset($user_id)) return $return;
        if (! isset($quota)) return $return;
        if (! isset($userorder)) $userorder = 1;

        $q = '
        SELECT user_id,user_code, l.level_name, l.level_hierarchy, u.parent_user_id, ' . $userorder . ' as userorder, 
        (
            SELECT COUNT(user_id)
            FROM ms_user mu 
            WHERE mu.parent_user_id = u.user_id
        ) as totalchild
        FROM ms_user u 
        LEFT JOIN ms_level l USING (level_id)
        WHERE 1 AND u.parent_user_id = ' . $user_id;
        $listchild = orm_get_list($q,'json');
		$listchild = json_decode($listchild,1);
		// debug($listchild,1);

        if (! empty($listchild)) {
			$temp = NULL;
			$total_person = count($listchild);
            foreach ($listchild as $x => $rc) {
				
				// Count quota here
				$tmpquota = $quota / $total_person;
				if (strpos($tmpquota,'.')) {
					
					// round up on last round
					if ($x == ($total_person - 1)) {
						$tmpquota = ceil($tmpquota);
					} else {
						$tmpquota = floor($tmpquota);
					}
				}

				$rc['quota'] = $tmpquota;
				
				$rc['userorder'] = $userorder;

				// Update quota to user
				$save = DB::table($this->table)->where($this->primary_key,$rc['user_id'])->update(array('quota_remaining' => $tmpquota));

				$temp[] = $rc;
				
				// Still have child
                if ($rc['totalchild'] > 0) {
					
					$tempchild = NULL;
                    $tempchild = $this->get_list_child($rc['user_id'],$tmpquota,($userorder + 1));
					$temp[$x]['listchild'] = $tempchild;
					$temp[$x]['userorder'] = $userorder;
                } else {
					// No chilld
					// $userorder--;
					// $quota = $quota;
                    $temp[$x]['listchild'] = array();
                    $temp[$x]['is_bottom_child'] = '1';
					$temp[$x]['userorder'] = $userorder;
				}
				// $userorder++;

			}
			
            $return = $temp;
        }

        return $return;
	}
	// TOPDOWN END
	// ================================================================================
	
	// ================================================================================
	// BOTTOM UP START
	// QC : notyet
	// Get list bottom level child, sort by level_hierarchy
	public function get_list_bottom_level_child()
	{
		$attr = NULL;

		if ($_GET) $attr = $_GET;
		if (! isset($attr['site_id'])) return ' site_id harus diisi';

		$q = '
		SELECT u.user_id, u.parent_user_id, u.user_code, l.level_id , l.level_hierarchy, l.level_name, u.quota_initial, u.quota_additional, u.quota_remaining
		FROM ms_user u 
		LEFT JOIN ms_level l USING(level_id)
		WHERE u.user_id NOT IN (
			SELECT mu.parent_user_id 
			FROM ms_user mu
			WHERE mu.parent_user_id IS NOT NULL
		) AND u.parent_user_id IS NOT NULL AND u.site_id = ' . replace_quote($attr['site_id']) . ' 
		ORDER BY l.level_hierarchy DESC, l.level_id ASC
		';
		// debug($q,1);

		$listchild = orm_get_list($q,'json');
		$listchild = json_decode($listchild,1);

		$return = $userorder = NULL;
		$quota = 0;
		if (! empty($listchild)) {
			foreach ($listchild as $key => $rs)
			{
				// $rs;
				$userorder = 1;
				$quota = $rs['quota_initial'];
				if (! isset($quota)) $quota = 30;

				$return[] = $rs;
				if (isset($rs['parent_user_id'])) {
					$return[$key]['parent'] = $this->get_list_parent($rs['parent_user_id'], $quota, $userorder);
				} else {

				}
			}
		}

		debug($return,1);
		// debug($listchild,1);
	}

	// Recursive function get all child below level
	// userorder = user hierarchy level
    private function get_list_parent($parent_user_id, $quota, $userorder)
    {
        $return = $listparent = NULL;

        if (! isset($parent_user_id)) return $return;
        if (! isset($quota)) return $return;
        if (! isset($userorder)) $userorder = 1;

        $q = '
        SELECT user_id, user_code, u.quota_initial, u.quota_additional, u.quota_remaining, l.level_name, l.level_hierarchy, u.parent_user_id, ' . $userorder . ' as userorder, 
        (
            SELECT COUNT(user_id)
            FROM ms_user mu 
            WHERE mu.parent_user_id = u.user_id
        ) as totalparent
        FROM ms_user u 
        LEFT JOIN ms_level l USING (level_id)
        WHERE 1 AND u.user_id = ' . $parent_user_id;
        $listparent = orm_get_list($q,'json');
		$listparent = json_decode($listparent,1);
		// debug($q,1);
		// debug($listparent,1);

        if (! empty($listparent)) {
			$temp = NULL;
			$total_person = count($listparent);
            foreach ($listparent as $x => $rc) {
				
				// Increment quota user when not null
				if (isset($rc['quota_initial'])) $quota += $rc['quota_initial'];

				$tmpquota = $quota;

				// No need to sum up or down
				// if (strpos($tmpquota,'.')) {
					
				// 	// round up on last round
				// 	if ($x == ($total_person - 1)) {
				// 		$tmpquota = ceil($tmpquota);
				// 	} else {
				// 		$tmpquota = floor($tmpquota);
				// 	}
				// }

				$rc['quota'] = $tmpquota;
				
				$rc['userorder'] = $userorder;
				$temp[] = $rc;
				
				// Parent level
                if ($rc['totalparent'] > 0) {
					
					$tempparent = NULL;
                    $tempparent = $this->get_list_parent($rc['parent_user_id'],$tmpquota,($userorder + 1));
					$temp[$x]['listparent'] = $tempparent;
					$temp[$x]['userorder'] = $userorder;
                } else {
					// No chilld
					// $userorder--;
					// $quota = $quota;
                    $temp[$x]['listparent'] = array();
                    $temp[$x]['is_bottom_child'] = '1';
					$temp[$x]['userorder'] = $userorder;
				}
				// $userorder++;

			}
			
            $return = $temp;
        }

        return $return;
	}
	// BOTTOM UP END
	// ================================================================================
	

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