<?php 

/*
 * -------------------------------------------------------------------------------------------
 * ORM HELPER
 * -------------------------------------------------------------------------------------------
*/
// Return single data record
function orm_get($query, $column = NULL, $format = NULL)
{
	if (!isset($query)) 
		return 'orm_get error empty string';
	
	$data = NULL;
	$data = DB::select($query);
	if ($data) {
		$data = $data[0];
		if (! empty($column)) $data = $data->$column; 
	} else {
		// debug('Data query error');
		// debug($query,1);
		$data = NULL;
	}
	// if set return single column else return array of columns
	// $data = json_decode(json_encode($data),1);
	if (isset($format) && $format == 'json') {
		$data = json_encode($data);
	}
	
	return $data;
}

// Return list data record
function orm_get_list($query, $format = NULL)
{
	if (!isset($query)) 
		return 'orm_get_list error empty string';
	
	$data = NULL;
	$data = DB::select($query);
	
	// $data = json_decode(json_encode($data),1);

	if (isset($format) && $format == 'json') {
		$data = json_encode($data);
	}
		
	return $data;
}

function debug($arr,$is_die = false)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if ($is_die) die;
}

/*
 *  returns SQL with values in it
 */
function getSql($model)
{
    $replace = function ($sql, $bindings)
    {
        $needle = '?';
        foreach ($bindings as $replace){
            $pos = strpos($sql, $needle);
            if ($pos !== false) {
                if (gettype($replace) === "string") {
                     $replace = ' "'.addslashes($replace).'" ';
                }
                $sql = substr_replace($sql, $replace, $pos, strlen($needle));
            }
        }
        return $sql;
    };
    $sql = $replace($model->toSql(), $model->getBindings());

    return $sql;
}

function replace_quote($str, $type='str')
{
	if ($type == 'like') {
		$str = "'%" . $str . "%'";
	} else {
		
		$str = "'" . $str . "'";
	}
	
	return $str;
}

/*
 * Remove all column not registered in $arrsource
 * --------------------------------------
 * return: array - array of invalid parameter submitted by user. ex: array()
 * --------------------------------------
 * @arrsource : array of string. 
 * @arrtarget : array of string. 
*/
function validate_column($arrsource,$arrtarget) {
	
	if (empty($arrsource) || empty($arrtarget)) {
		return 'helper error: validate_column error parameter';
	}	
	
	$temp = NULL;
	foreach ($arrsource as $rs) {
		if (isset($arrtarget[$rs])) $temp[$rs] = $arrtarget[$rs];
	}
	
	return $temp;
}

/*
 * Check all column required whether fulfilled or not.(must fill all required_column)
 * --------------------------------------
 * return: string - string of all invalid parameter submitted by user, ex: user,role
 * --------------------------------------
 * @arrsource : array of string . 
 * @arrtarget : array of string postdata. 
*/
function validate_required_column($arrsource,$arrtarget) {
	
	if (empty($arrsource) || empty($arrtarget)) {
		return 'helper error: validate_required_column error parameter';
	}	
	
	$temp = NULL;
	foreach ($arrsource as $rs) {
		if (! isset($arrtarget[$rs]) || $arrtarget[$rs] == '') {
			$temp[] = $rs;
		}
	}

	// merge list of array into string
	if (! empty($temp)) $temp = implode(',',$temp);

	return $temp;
}

?>