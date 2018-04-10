<?php
// including the config file
include('config.php');
$pdo = connect();
$str = '';
if (isset($_POST)) {
	$niche = $_POST['niche']; 
	$country = $_POST['country'];
	$first_name = $_POST['first_name'];
	
	
	$arr = array();
	$arr['niche'] = $niche;
	$arr['country'] = $country;
	$arr['first_name'] = $first_name;
	
	foreach ($arr as $key => $value) {
		if (is_null($value) || $value == '') continue;
		if (strlen($str) == 0) {
			$str .= "?".$key."=".$value;
		} else {
			$str .= "&".$key."=".$value;	
		}
	}
}
header('location: index.php'.$str);
?>