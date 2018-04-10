<?php 
	$url = $_SERVER['QUERY_STRING'];
	$niche = $country = $first_name = '';
	
	//index khong co search
	if (strlen($url) == 0) {
		$sql = 'SELECT * FROM members ORDER BY id ASC';
	} 
	//index xuat hien search
	else {
		$tmp_str = '';
		$tmp = explode("&", $url);
		foreach ($tmp as $value) {
			$tmp_value = explode("=", $value);
			
			if ( strpos($tmp_value[0], 'niche') !== false) $niche = $tmp_value[1];
			else if ( strpos($tmp_value[0], 'country') !== false) $country = $tmp_value[1];
			else if ( strpos($tmp_value[0], 'first_name') !== false) $first_name = $tmp_value[1];

			if (strlen($tmp_str) == 0) {
				$tmp_str .= $tmp_value[0]." LIKE '%".$tmp_value[1]."%'";		
			} else {
				$tmp_str .= " AND ".$tmp_value[0]." LIKE '%".$tmp_value[1]."%'";	
			}
		}
		$sql = 'SELECT * FROM members WHERE '.$tmp_str.' ORDER BY id ASC';
		
	}
?>