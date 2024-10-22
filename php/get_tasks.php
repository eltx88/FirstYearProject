<?php

$user_id = $_SESSION["user_id"];
//Array that we use to map id of hobbie to their name
$tasks_array = [
	"1" => "0",
	"2" => "0",
	"3" => "0",
	"4" => "0",
	"5" => "0",
	"6" => "0",
	"7" => "0",
	"8" => "0",
	"9" => "0",
	"10" => "0"
];

$pdo_get_tasks = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password); 

$pdo_get_tasks->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$get_tasks_sql = "SELECT tasks FROM user_info WHERE user_id = :user_id";

$stmt_get_tasks = $pdo_get_tasks->prepare($get_tasks_sql);

$stmt_get_tasks->execute([
	'user_id' => $user_id
]);

$stmt_get_tasks->setFetchMode(PDO::FETCH_ASSOC);

if ($row = $stmt_get_tasks->fetch()) 
{
	$tasks_user = $row["tasks"];
}
#creates copy of tasks array
$loaded_progress = 0;
if($tasks_user != null)
{
	$tasks_user = explode(",", $tasks_user);
	foreach($tasks_user as $user)
	{
		#assigns tasks id to the place where this id points to in array. Needed for activating checkboxes in profile page
		$tasks_array[$user] = $user;
        $loaded_progress += 10;
	}
    
}


?>