<?php

$pdo_get_info = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password); 
$pdo_get_info->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$user_id = $_SESSION["user_id"];
$data = array();

function start() {
	global $pdo_get_info, $user_id, $data;
	$get_info_sql = "SELECT user_id, username, hashed_password, email_address, firstname, lastname, phone_number, nationality, course, accommodation, biography, private_account FROM user_info WHERE user_id = :user_id";

	$stmt_get_info = $pdo_get_info->prepare($get_info_sql);

	$stmt_get_info->execute([
		'user_id' => $user_id
	]);

	$stmt_get_info->setFetchMode(PDO::FETCH_ASSOC);

	if ($row = $stmt_get_info->fetch()) {
		$data = array(
			'user' => $user_id,
			'username' => $row["username"],
			'firstname' => $row["firstname"],
			'lastname' => $row["lastname"],
			'email_address' => $row["email_address"],
			'phone_number' => $row["phone_number"],
			'nationality' => $row["nationality"],
			'course' => $row["course"],
			'accommodation' => $row["accommodation"],
			'biography' => $row["biography"],
			'private_account' => $row["private_account"]
		);
	}
}

start();

?>