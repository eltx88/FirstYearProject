<?php

$pdo= new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$hobby_convert_arr = [
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

if(isset($_POST["add_topic"])) {
	$name = str_replace(" ", "_", $_POST["add_topic_name"]) . ":topic";

	if ($name == ":topic") {
		echo "<script>alert('Topic name cannot be empty');</script>";
	} else {
		add_topic($name);
	}
}

function add_topic($topic_name){
	global $pdo;

	$sql_add_topic = "INSERT INTO topics (topic_name) VALUES (:topic_name)";

	$stmt_add_topic = $pdo->prepare($sql_add_topic);

	$stmt_add_topic->execute(["topic_name"=>$topic_name]); 
}

function get_topics() {
	global $pdo;

	$sql_get_topics = "SELECT topic_id, topic_name, date_created FROM topics WHERE topic_name LIKE '%:topic' ORDER BY date_created DESC";

	$stmt_get_topic = $pdo->prepare($sql_get_topics);

	$stmt_get_topic->execute();

	$data = $stmt_get_topic->fetchAll();
	$topics = array();

	foreach($data as $data_element) {
		$topics[] = array(
			"id" => $data_element["topic_id"],
			"topic" => str_replace(":topic", "", $data_element["topic_name"]),
			"date" => $data_element["date_created"]
		);		
	}
	return $topics;
}	

function display_topics() {
	$topics = get_topics();
	$html = "";

	for ($i = 0; $i < sizeof($topics); $i++) {
		$topic_name = str_replace("_", " ", $topics[$i]["topic"]);
		$id = $topics[$i]['topic'] . "_topic";
		$list_item = "
		<li id='$id'><a onclick='open_topic(`$id`);'>$topic_name</a></li>
		";

		$html .= $list_item;
	}

	return $html;
}

function display_content_divs() {
	$topics = get_topics();
	$html = "";

	for ($i = 0; $i < sizeof($topics); $i++) {
		$topic_name = str_replace("_", " ", $topics[$i]);
		$content_id = $topics[$i]['topic'] . "_topic_content";
		$form_name = "add_chat_topic_" . $topics[$i]['topic'];
		$topic_get_return = get_topic($topics[$i]["id"]);

		if ($topic_get_return == "") {
			$topic_get_return = "<h3 class='hello'>There are no posts, be the first to say hello!</h3>";
		}

		$html .= "
		<div  id='$content_id' style='display:none;' class='forum chat'>
			<div class='boxout' id='boxout'>
				<div class='box' id='box'>
					<div class='forum_section chat_section'>
						$topic_get_return
					</div>
				</div>
				<div class='chat_footer'>
					<form method='post'> 
						<textarea name='text_box' type='text' id='text_box'></textarea>
						<label><i class='bx bx-send'><input type='submit' name='$form_name' value=''></i></label>
					</form>
				</div>
			</div>
		</div>";
	}

	return $html;
}

function get_topic_names() {
	global $pdo;

	$sql_get_topics = "SELECT topic_id FROM chat_log WHERE 1";
	$stmt_get_topics = $pdo->prepare($sql_get_topics);
	$stmt_get_topics->execute();

	$data = $stmt_get_topics->fetchAll();
	$topics = array();

	foreach ($data as $data_element) {
		$current_topic = $data_element['topic_id'];

		// if the current topic ends in _topic then it must be a topic
		//		strip _topic
		if (substr($current_topic, -5) == "topic") {

		}


		// else continue

		$trimmed_current_topic = str_replace("_topic", "", $current_topic);

		if (!in_array($trimmed_current_topic, $topics)) {
			if (strlen($data_element['topic_id']) > 5 && substr($data_element['topic_id'], -5) == "topic") {
				$topics[] = $trimmed_current_topic;
			}
		}
	}
	return $topics;
}

$topics = get_topic_names();

for ($i = 0; $i < sizeof($topics); $i++) {
	$post_val = "add_chat_topic_" . $topics[$i];
	if (isset($_POST[$post_val])) {
		if (!empty($_POST["text_box"])) {
			$topic = $topics[$i] . "_topic";
			add_topic_post($topic, $_POST["text_box"]);
		}
	}
}

// added for loop for adding data to the database on the topics
$topics = get_topics();

for ($k = 0; $k < sizeof($topics); $k++) {
	$add_val_topics = "add_chat_topic_" . $topics[$k]["topic"];

	if (isset($_POST[$add_val_topics])) {
		if (!empty($_POST["text_box"])) {
			add_topic_post($topics[$k]["id"], $_POST["text_box"]);
		}
	}
}

// added for loop for adding replies to the database
for ($l = 0; $l < sizeof($topics); $l++) {
	$add_reply_topics = "add_chat_reply_" . $topics[$l]["topic"];

	if (isset($_POST[$add_reply_topics])) {
		if (!empty($_POST["text_box"])) {
			add_topic_post($topics[$l]["id"], $_POST["text_box"], true, $_POST["chat_id"]);
		}
	}	
}

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

function get_topic($topic_id) {
	global $pdo, $user_info_arr, $hobby_convert_arr;

	$sql_get_topic = "
		SELECT c.chat_id, c.user_id, c.log_date, c.text_content, c.reply_to, u.username, t.topic_name 
		FROM ((chat_log AS c INNER JOIN topics AS t ON (t.topic_name = t.topic_name)) INNER JOIN user_info AS u ON (u.username = u.username)) 
		WHERE (c.topic_id = :topic_id AND t.topic_id = :topic_id AND u.user_id = c.user_id) ORDER BY log_date ASC, c.reply_to ASC;";

	$stmt_get_topic = $pdo->prepare($sql_get_topic);
	$stmt_get_topic->execute(['topic_id' => $topic_id]);

	$stmt_get_topic->setFetchMode(PDO::FETCH_ASSOC);

	$data = $stmt_get_topic->fetchAll();
	$new_data = array();

	foreach ($data as $element) {
		if ($element["reply_to"] == null) {
			$element_to_add = $element;
			$element_to_add["indent"] = 0;

			$new_data[] = $element_to_add;
			$index_to_remove = array_search($element, $data);
			unset($data[$index_to_remove]);
		}
	}
	// echo "length of chats is" . sizeof($data);

	// i used for the indent counter
	$i = 0;
	// while there are still elements in the array
	while (sizeof($data) != 0) {
		$i++;

		// for each element in the new_data array
		foreach($new_data as $new_data_el) {
			$chat_id = $new_data_el["chat_id"];
			// counter to hold the number of items added to the replies
			$added = 1;

			// for each element in the old data array
			foreach ($data as $old_data_el) {
				// if its reply_to value is the same as chat id of the current element we are looking at
				if ($old_data_el["reply_to"] == $chat_id) {
					// copy array and add indent key, idk why but without copying it its very slow
					$old_data_el_add = $old_data_el;
					$old_data_el_add["indent"] = $i;

					// add the reply in after the position of the new element in the array
					array_splice($new_data, array_search($new_data_el, $new_data) + $added, 0, array($old_data_el_add));
					// removing the old element from the list
					$index_to_remove_2 = array_search($old_data_el, $data);
					unset($data[$index_to_remove_2]);

					$added++;
				}
			}
		}	
	}

	get_user_info();

	$chat_posts = "";

	foreach ($new_data as $row) {
		$chat_id_from_db = $row["chat_id"];
		$topic_name_from_db = str_replace(":topic", "", $row["topic_name"]);
		$username_from_db = $row["username"];
		$log_date_from_db = $row["log_date"];
		$text_content_from_db = $row["text_content"];
		$reply_val_from_db = $row["reply_to"];
		$indent_val = $row["indent"];

		// this stores all the data about the person whos chat it is
		$user_data = $user_info_arr[$username_from_db];	
		$user_info = "";


		if (isset($user_data["private_account"])) {
			$user_info = "<p>This account is private.</p>";
		} else {
			$firstname = mb_convert_case($user_data["firstname"], MB_CASE_TITLE, 'UTF-8');
			$lastname = mb_convert_case($user_data["lastname"], MB_CASE_TITLE, 'UTF-8');
			$nationality = mb_convert_case($user_data["nationality"], MB_CASE_TITLE, 'UTF-8');
			$course = mb_convert_case($user_data["course"], MB_CASE_TITLE, 'UTF-8');
			$accommodation = mb_convert_case($user_data["accommodation"], MB_CASE_TITLE, 'UTF-8');
			$biography = $user_data["biography"];

			$hobbies_arr = explode(",", $user_data["hobbies"]);
			$hobbies = "";

			foreach($hobbies_arr as $hobby) {
				if ($hobby != null) {
					$hobbies .= $hobby_convert_arr[$hobby] . ", ";
				}
			}

			$hobbies = substr($hobbies, 0, -2);

			$user_info = "
			<p>Name: $firstname $lastname</p>
			<p>Nationality: $nationality</p>
			<p>Course: $course</p>
			<p>Accommodation: $accommodation</p>
			<p>Biography: $biography</p>
			<p>Hobbies: $hobbies</p>
			";
		}

		// 2022-02-16 21:35:11
		$log_time = substr($log_date_from_db, 11, 5);
		$log_date = substr($log_date_from_db, 5, 2) ."/". substr($log_date_from_db, 8, 2) ."/". substr($log_date_from_db, 2, 2);

		$html_chat_box = "<div class='forum_box";

		if (!$reply_val_from_db == null) {
			$html_chat_box .= " reply$indent_val";
		}

		$html_chat_box .= "' id='chat_box_$chat_id_from_db'>
			<div class='forum_box_details'> 
				<h3 class='username_h3'>$username_from_db<span class='profile_info'>$user_info</span></h3>
				<p>&nbsp@ $log_time</p>
				<p class='date'>$log_date</p>
			</div>
			<div class='text_area'>
				<p class='text_content'>$text_content_from_db</p>
				<a class='reply_link' onclick='open_reply(`$chat_id_from_db`);'>Reply</a>
			</div>
		</div>
		<div id='reply_box_$chat_id_from_db' class='reply_box'>
			<form method='post'>
				<input type='hidden' name='chat_id' value='$chat_id_from_db'>
				<label for='text_box'>Add a reply to this chat:</label>
				<textarea name='text_box' type='text' id='text_box'></textarea>
				<input id='reply_button' type='submit' name='add_chat_reply_$topic_name_from_db' value='Submit post'>
			</form>
		</div>";

		$chat_posts .= $html_chat_box;
	}

	return $chat_posts;
}

function add_topic_post($topic, $text_content, $reply = false, $chat_id = null) {
	global $pdo;

	$log_date = date("d/m/Y H:i");

	if ($reply == false && $chat_id == null) {
		$sql_add_topic_post = "INSERT INTO chat_log (user_id, topic_id, text_content) VALUES (:user_id, :topic_id, :text_content)";

		$stmt_add_topic_post = $pdo->prepare($sql_add_topic_post);

		$stmt_add_topic_post->execute([
			'user_id' => $_SESSION["user_id"],
			'topic_id'=> $topic,
			'text_content' => trim($_POST["text_box"])
		]);
	} else {
		$sql_add_topic_post = "INSERT INTO chat_log (user_id, topic_id, text_content, reply_to) VALUES (:user_id, :topic_id, :text_content, :reply_to)";

		$stmt_add_topic_post = $pdo->prepare($sql_add_topic_post);

		$stmt_add_topic_post->execute([
			'user_id' => $_SESSION["user_id"],
			'topic_id'=> $topic,
			'text_content' => trim($_POST["text_box"]),
			'reply_to' => $chat_id
		]);
	}
}

function display_topic_table() {
	global $topics;

	$html = "<table id='topics_table'>";

	foreach ($topics as $topic) {
		$id = $topic["topic"] . "_topic";
		$date = $topic["date"];

		$log_time = substr($date, 11, 5);
		$log_date = substr($date, 5, 2) ."/". substr($date, 8, 2) ."/". substr($date, 2, 2);

		$html .= "<tr><td onclick='open_topic(`$id`);'><a>" . str_replace("_", " ", $topic["topic"]) . "<p>Created: $log_date @ $log_time</p></a></td></tr>";
	}

	$html .= "</table>";

	return $html;
}

?>