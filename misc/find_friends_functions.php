<?php

$pdo= new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$user_info_arr = array();

function get_user_info() {
	global $pdo, $user_info_arr;

	$sql_get_user_info = "SELECT username, firstname, lastname, nationality, course, accommodation, biography, private_account, hobbies FROM user_info WHERE 1";

	$stmt_get_user_info = $pdo->prepare($sql_get_user_info);
	$stmt_get_user_info->execute();

	$stmt_get_user_info->setFetchMode(PDO::FETCH_ASSOC);
	$data = $stmt_get_user_info->fetchAll();

	foreach ($data as $row) {
		$username = $row["username"];

		if ($row["private_account"] == 1) {
			$user_info_arr[$username] = array("private_account" => 1);
		} else {
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$nationality = $row["nationality"];
			$course = $row["course"];
			$accommodation = $row["accommodation"];
			$biography = $row["biography"];
			$hobbies = $row["hobbies"];

			$user_info_arr[$username] = array(
				"firstname" => $firstname, 
				"lastname" => $lastname, 
				"nationality" => $nationality, 
				"course" => $course, 
				"accommodation" => $accommodation, 
				"biography" => $biography, 
				"hobbies" => $hobbies);
		}		
	}
}

?>