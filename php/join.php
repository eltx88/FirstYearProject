<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["join_button"])) { // if they are registering
		// Validate username
		$error_message_join = "";

		if (empty(trim($_POST["username_join"]))) {
			$error_message_join .= " Please enter a username. ";
		} else {
			$temp_username = trim($_POST["username_join"]);
			$regex = "/^(?=.{3,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/";

			if (!preg_match($regex, $temp_username)) {
				$error_message_join .= " Username must be at least 3 characters long and only contain lowercase, uppercase, digits, underscores and dots. ";
			} else {
				$join_username = trim($_POST["username_join"]);
			}

			$join_username = trim($_POST["username_join"]);
		}

		// Validate email
		if (empty(trim($_POST["email_join"]))) {
			$error_message_join .= " Please enter an email. ";
		} else {
			if (!filter_var(trim($_POST["email_join"]), FILTER_VALIDATE_EMAIL)) {
				$error_message_join .= " Invalid email format. ";
			} else {
				$join_email = trim($_POST["email_join"]);
			}
		}

		// Validate password
		if (empty(trim($_POST["password_join"]))) {
			$error_message_join .= " Please enter a password. ";
		} else {
			if (strlen(trim($_POST["password_join"])) < 8) {
				$error_message_join .= " Password must be 8 characters in length. ";
			} else {
				$temp_password = trim($_POST["password_join"]);
				$regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

				if (!preg_match($regex, $temp_password)) {
					$error_message_join .= " Password must be 8 characters in length and contain: uppercase, lowercase, digits and symbols. ";
				} else {
					$join_password = trim($_POST["password_join"]);
				}
			}
		}

		// Validate password confirmation
		if (empty(trim($_POST["password_confirm_join"]))) {
			$error_message_join .= " Please confirm your password. ";
		} else if (isset($join_password)) {
			$join_password_confirm = trim($_POST["password_confirm_join"]);
			if ($join_password_confirm != $join_password) {
				$error_message_join .= " Passwords do not match. ";
			} else {
				$passwords_match = 1; // this is used to validate the passwords match before adding to DB
			}
		} else {
			$error_message_join .= "";
		}

		if (isset($passwords_match) && isset($join_password) && isset($join_email) && isset($join_username)) {
			// add the data to the database
			$hashed_password = password_hash($join_password, PASSWORD_DEFAULT);

			$sql_join = "INSERT INTO user_info (username, hashed_password, email_address) VALUES (:username, :hashed_password, :email_address) ";

			$pdo_join = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);

			$pdo_join->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

			$stmt_join = $pdo_join->prepare($sql_join);
			$stmt_join->execute([
				'username' => $join_username,
				'hashed_password' => $hashed_password,
				'email_address' => $join_email
			]);

			$sql_get_info_after_joining = "SELECT user_id, username, email_address FROM user_info WHERE username = :username AND email_address = :email_address";

			$stmt_get_info_after_joining = $pdo_join->prepare($sql_get_info_after_joining);
			$stmt_get_info_after_joining->execute(['username' => $join_username, 'email_address' => $join_email]);

			$data = $stmt_get_info_after_joining->fetchAll();

			if (sizeof($data) > 1) {
				header("Location: homepage.php");
			} else {
				session_start();

				$_SESSION["logged_in"] = true;
 				$_SESSION["user_id"] = $data[0]["user_id"];
 				$_SESSION["username"] = $data[0]["username"];
 				$_SESSION["email_address"] = $data[0]["email_address"];

 				echo $_SESSION['user_id'] . "HEY USER";

 				header("Location: profile_page.php");
			}
		}
	}
} 

?>