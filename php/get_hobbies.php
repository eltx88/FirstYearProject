<?php

$user_id = $_SESSION["user_id"];
//Array that we use to map id of hobbie to their name
$hobbies_array = [
	"1" => "sports",
	"2" => "baking",
	"3" => "art",
	"4" => "gaming",
	"5" => "music",
	"6" => "dance",
	"7" => "photography",
	"8" => "singing",
	"9" => "electronics",
	"10" => "biking",
	"11" => "reading",
	"12" => "fishing",
	"13" => "traveling",
	"14" => "cars",
	"15" => "yoga",
	"16" => "hiking"
];

$pdo_get_hobbies = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password); 

$pdo_get_hobbies->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$get_hobbies_sql = "SELECT hobbies FROM user_info WHERE user_id = :user_id";

$stmt_get_hobbies = $pdo_get_hobbies->prepare($get_hobbies_sql);

$stmt_get_hobbies->execute([
	'user_id' => $user_id
]);

$stmt_get_hobbies->setFetchMode(PDO::FETCH_ASSOC);

if ($row = $stmt_get_hobbies->fetch()) {
	$hobbies_user = $row["hobbies"];
}

#creates copy of hobbies array
$hobbies_user_array = $hobbies_array;

if(isset($hobbies_user) && $hobbies_user != null)
{
	$hobbies_user = explode(",", $hobbies_user);
	foreach($hobbies_user as $user)
	{
		#assigns hobbies id to the place where this id points to in array. Needed for activating checkboxes in profile page
		$hobbies_user_array[$user] = $user;
	}
}


?>