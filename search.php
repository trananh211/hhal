<?php
// including the config file
include('config.php');
$pdo = connect();
echo "<pre>";
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


/*
// we initialize the output with the headers
$output = "full_name,first_name,last_name,email,mobile,birthday, niche, country, created\n";
// select all members
$sql = 'SELECT * FROM members ORDER BY id ASC';
$query = $pdo->prepare($sql);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// add new row
    $output .= $rs['full_name'].",".$rs['first_name'].",".$rs['last_name'].",".$rs['email'].",".$rs['mobile'].",".$rs['birthday'].",".$rs['niche'].",".$rs['country'].",".$rs['created'].",".$rs['mobile']."\n";
}
// export the output
echo $output;
*/

echo "</pre>";
header('location: index.php'.$str);
?>