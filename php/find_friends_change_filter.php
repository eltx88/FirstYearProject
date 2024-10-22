<?php

require("../config.php");

$pdo = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// get all the user info from the database
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

get_user_info();

// the data taken from the page
$course = $_POST["data"][0];
$accommodation = $_POST["data"][1];
$hobbies = $_POST["data"][2];
$nationality = $_POST["data"][3];

// this array + foreach loop adds the correct user data for the filters applied
$user_arr_fulfil = array();
foreach($user_info_arr as $user => $user_data) {
	if (isset($user_data["private_account"])) {
		continue;
	}
	
	$could_add = true;

	if ($user_data["course"] != $course and $course != "none") {
		$could_add = false;
	}

	if ($user_data["nationality"] != $nationality and $nationality != "none") {
		$could_add = false;
	}

	if (sizeof($accommodation) != 1) {
		$could_add_accom = false;

		foreach($accommodation as $accom) {
			if ($user_data["accommodation"] == $accom and $accom != "") {
				$could_add_accom = true;
			}
		}

		if (!$could_add_accom) {
			$could_add = false;
		}
	}
	
	if (sizeof($hobbies) != 1) {
		$could_add_hobby = false;

		foreach($hobbies as $hobby) {
			if ($hobby != "" and $user_data["hobbies"] != "") {
				if (strlen($hobby) == 1) {
					if(!is_numeric(substr($user_data["hobbies"], strpos($user_data["hobbies"], $hobby) - 1, 1)))
					{
						if(strpos($user_data["hobbies"], $hobby) + 1 < strlen($user_data["hobbies"]))
						{
							if(!is_numeric(substr($user_data["hobbies"], strpos($user_data["hobbies"], $hobby) + 1, 1)))
							{
							$could_add_hobby = true;
							}
						}else
						{
							$could_add_hobby = true;
						}
						
					}
					
						
				}
				else
				{
					if (strpos($user_data["hobbies"], $hobby) != false and $hobby != "") {
						$could_add_hobby = true;
					}
				}
				
			}
		}

		if (!$could_add_hobby) {
			$could_add = false;
		}
	}
	
	if ($could_add) {
		$user_arr_fulfil[$user] = $user_data;
	}
}

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


$html = "";
foreach($user_arr_fulfil as $user => $user_data) {
	$username = $user;
	$firstname = $user_data["firstname"];
	$lastname = $user_data["lastname"];

	if ($user_data["nationality"] == $_POST["data"][3]) {
		$nationality = "<b>" . ucwords($user_data["nationality"]) . "</b>";
	} else {
		$nationality = ucwords($user_data["nationality"]);
	}

	if ($user_data["course"] == $_POST["data"][0]) {
		$course = "<b>" . ucwords($user_data["course"]) . "</b>";
	} else {
		$course = ucwords($user_data["course"]);
	}

	if (in_array($user_data["accommodation"],$_POST["data"][1])) {
		$accommodation = "<b>" . ucwords($user_data["accommodation"]) . "</b>";
	} else {
		$accommodation = ucwords($user_data["accommodation"]);
	}
	
	$biography = $user_data["biography"];

	$hobbies_exploded = explode(",", $user_data["hobbies"]);
	$hobbies = "";

	foreach ($hobbies_exploded as $hobby) {
		if ($hobby != "") {
			if (in_array($hobby, $_POST["data"][2])) {
				$hobbies .= "<b>" . $hobbies_array["$hobby"] . "</b>" . ", ";
			} else {
				$hobbies .= $hobbies_array["$hobby"] . ", ";
			}
		}	
	}

	$hobbies = substr($hobbies, 0, -2);

	$nationality = ucfirst($nationality);
	$course = ucfirst($course);
	$accommodation = ucfirst($accommodation);

	$html .= "
	<div class='user_box'>
		<div id='user_logo'><i class='bx bxs-user-circle'></i></div>
		<div class='left_side'>
			<h3>$username</h3>
			<p class='name'>Name: $firstname $lastname</p>
			<p class='nationality'>Nationality: $nationality</p>
			<p class='accommodation'>Accommodation: $accommodation</p>
		</div>
		<div class='right_side'>
			<p class='course'>Course: $course</p>
			<p class='hobbies'>Hobbies: $hobbies</p>
			<p class='biography'>Biography: $biography</p>
		</div>
	</div>";
}

echo $html;


?>