<?php

if (isset($_POST["save_changes_button"])) {
	$pdo_change_info = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
	$pdo_change_info->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	// this first foreach loop just goes through each input and locates any errors, if any exist, the info is not updated.
	foreach ($_POST as $name => $value) {
		if ($name == "save_changes_button") {
			continue;
		} else {
			if ($value != "") {
				if ($name == "email_address") {
					if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
						$email_address_error = true;
					}
				} else if ($name == "phone_number") {
					// this regex works for 99% of phone numbers so should be sufficient
					$regex_phone_numbers = "/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im";

					if (!preg_match($regex_phone_numbers, $value)) {
						$phone_number_error = true;
					}
				} else if ($name == "firstname") {
					$regex_name = "/^[a-zA-Z]+$/";

					if (!preg_match($regex_name, $value)) {
						$firstname_error = true;
					}

				} else if ($name == "lastname") {
					$regex_name = "/^[a-zA-Z]+$/";

					if (!preg_match($regex_name, $value)) {
						$lastname_error = true;
					}
				}
			}
		}
	}

	// this second foreach loop will only run if no errors occured.		
	// if ($value != "" && !isset($email_address_error) && !isset($firstname_error) && !isset($lastname_error) && !isset($phone_number_error)) {
	foreach ($_POST as $name => $value) {
		if ($name == "save_changes_button" || $name == "users_hobbies" || $name == "email_address" && isset($email_address_error) || $name == "firstname" && isset($firstname_error) || $name == "lastname" && isset($lastname_error) || $name == "phone_number" && isset($phone_number_error)) {
			continue;
		} else {
			$sql_change_info = "UPDATE user_info SET $name = :value WHERE user_id = :user_id";

			$stmt_change_info = $pdo_change_info->prepare($sql_change_info);
			if($name != "private_account")
			{
				$stmt_change_info->execute(['value' => $value, 'user_id' => $user_id]);
			}elseif(isset($_POST["private_account"]))
			{
				$stmt_change_info->execute(['value' => intval($value), 'user_id' => $user_id]);
			}
			

			
		}
	}

	if(!isset($_POST["private_account"])) {
		$sql_change_info = "UPDATE user_info SET private_account = :value WHERE user_id = :user_id";

		$stmt_change_info = $pdo_change_info->prepare($sql_change_info);

		$stmt_change_info->execute(['value' => 0, 'user_id' => $user_id]);

				
			}
	if(isset($_POST['users_hobbies'])) //if some hobbies are selected
	{
		$hobbies_string = "";

		foreach($_POST['users_hobbies'] as $hobby)
		{
			$hobbies_string .= $hobby . ",";
		}
		$hobbies_string = substr_replace($hobbies_string, "", -1);
	} else //if hobbies are not selected
	{
		$hobbies_string = NULL;
	}

	$sql_change_info = "UPDATE user_info SET hobbies = :value WHERE user_id = :user_id";

	$stmt_change_info = $pdo_change_info->prepare($sql_change_info);

	$stmt_change_info->execute(['value' => $hobbies_string, 'user_id' => $user_id]);

	//}
	
}

start();

?>