<?php
// including the config file
include('config.php');
$pdo = connect();

// set headers to force download on csv format
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=members.csv');

// we initialize the output with the headers
$output = "full_name,first_name,last_name,email,mobile,birthday, niche, country, created\n";
// select all members
include('getsql.php');

$query = $pdo->prepare($sql);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	$rs['niche'] = str_replace(",", "; ", $rs['niche']);
	// add new row
    $output .= $rs['full_name'].",".$rs['first_name'].",".$rs['last_name'].",".$rs['email'].",".$rs['mobile'].",".$rs['birthday'].", ".$rs['niche'].",".$rs['country'].",".$rs['created']."\n";
}
// export the output
echo $output;
exit;
?>


