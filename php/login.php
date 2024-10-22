<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["login_button"])) { // if they are logging in
		if (empty(trim($_POST["username_login"]))) {
			$error_message_login = "Please enter a username or email";
		} else {
			$email_regex = "/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/";

			if (preg_match($email_regex, trim($_POST["username_login"]))) {
				$email_login = trim($_POST["username_login"]);
			} else {
				// maybe add additional validation in case the email was not entered correctly
				$username_login = trim($_POST["username_login"]);
			}
		}

		if (empty(trim($_POST["password_login"]))) {
			$error_message_login = "Please enter a password";
 		} else {
 			$password_login = trim($_POST["password_login"]);
 		}

 		if (isset($password_login) && (isset($email_login) || isset($username_login))) {

 			$pdo_login = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);

 			$pdo_login->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

 			if (isset($email_login)) {
 				$sql_login = "SELECT user_id, username, hashed_password, email_address FROM user_info WHERE email_address = :email";

 				$stmt_login = $pdo_login->prepare($sql_login);

				$stmt_login->execute([
				 		'email' => $email_login
				]);
 			} elseif (isset($username_login)) {
 				$sql_login = "SELECT user_id, username, hashed_password, email_address FROM user_info WHERE username = :username";

 				$stmt_login = $pdo_login->prepare($sql_login);

				$stmt_login->execute([
				 		'username' => $username_login
				]);
 			}

 			$stmt_login->setFetchMode(PDO::FETCH_ASSOC);

 			if ($row = $stmt_login->fetch()) {
 				$db_user_id = $row["user_id"];
 				$db_username = $row["username"];
 				$db_hashed_password = $row["hashed_password"];
 				$db_email_address = $row["email_address"];

 				if (password_verify($password_login, $db_hashed_password)) {
 					session_start();

 					$_SESSION["logged_in"] = true;
 					$_SESSION["user_id"] = $db_user_id;
 					$_SESSION["username"] = $db_username;
 					$_SESSION["email_address"] = $db_email_address;

 					header("Location: homepage.php");
				} else {
					// password error
					$error_message_login = "Password was entered incorrectly.";
				}
 			} else {
 				if (isset($email_login)) {
 					$error_message_login = "Email not found.";
 				} elseif (isset($username_login)) {
 					$error_message_login = "Username not found.";
 				} else {
 					// incorrect login credentials - cannot tell if email or username
 					$error_message_login = "Username or email could not be verified.";
 				}
 			}
 		}
	}
}
?>