<?php 
// including the config file
include('config.php');
$pdo = connect();

$csv_file =  $_FILES['csv_file']['tmp_name'];
if (is_file($csv_file)) {
	$input = fopen($csv_file, 'a+');
	// if the csv file contain the table header leave this line
	$row = fgetcsv($input, 1024, ','); // here you got the header
	
	//kiem tra trung lap truoc
	$sql_check = 'SELECT email FROM members WHERE 1';
	$query_check = $pdo->prepare($sql_check);
	$query_check->execute();
	$list = $query_check->fetchAll();
	$arr = array();
	foreach ($list as $value) {
		$arr[] = $value['email'];
	}
	//end chuan bi mang
	
	while ($row = fgetcsv($input, 1024, ',')) {
		// insert into the database		
		$sql = 'INSERT IGNORE INTO members(full_name, first_name, last_name, email, mobile, birthday, niche, country, created) VALUES(:full_name, :first_name, :last_name, :email, :mobile, :birthday, :niche, :country, :created)';
		if (in_array(trim($row[3]), $arr)) {
			continue;
		}

		$query = $pdo->prepare($sql);
		$query->bindParam(':full_name', $row[0], PDO::PARAM_STR);
		//first name - last name
		$first_name = $row[2];
		$last_name = $row[3];
		if(strlen($row[2]) == 0) {
			$tmp_name = explode(" ", $row[0]);
			$first_name = $tmp_name[0];
			array_shift($tmp_name);
			$last_name = implode(" ", $tmp_name);
		}
		$query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
		$query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
		$query->bindParam(':email', $row[3], PDO::PARAM_STR);
		$query->bindParam(':mobile', $row[4], PDO::PARAM_INT);
		$query->bindParam(':birthday', $row[5], PDO::PARAM_STR);
		$row[6] = str_replace(",", "; ", $row[6]);
		$query->bindParam(':niche', $row[6], PDO::PARAM_STR);
		$query->bindParam(':country', $row[7], PDO::PARAM_STR);
		$query->bindParam(':created', $row[8], PDO::PARAM_STR);
		$query->execute();
	}
}
// redirect to the index page
header('location: index.php');
?>
