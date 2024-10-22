<?php

function get_forum_posts($forum) {
	global $host, $username_db, $password, $db_name, $forums;

	// get the forum id for the forum which was passed as we need this
	for ($i = 0; $i < sizeof($forums); $i++) {
		if ($forums[$i]["topic_name"] == $forum) {
			$topic_id = $forums[$i]["topic_id"];
			break;
		}
	}

	// could add if isset topic_id but should be true always

	$get_forum_post = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
	$get_forum_post->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	// get the c stuff and then get the username from the user_info table
	// where the username matches the c.user_id so we can add usernames to
	// each post on the forum
	$sql_get_posts = "SELECT c.chat_id, c.user_id, c.log_date, c.text_content, c.reply_to, u.username
		FROM (chat_log AS c INNER JOIN user_info AS u ON (u.username = u.username)) 
		WHERE c.topic_id = :topic_id AND u.user_id = c.user_id ORDER BY log_date ASC";

	$stmt_get_forum_post = $get_forum_post->prepare($sql_get_posts);

	$stmt_get_forum_post->execute([
		'topic_id'=> $topic_id
	]);

	$stmt_get_forum_post->setFetchMode(PDO::FETCH_ASSOC);
	$data = $stmt_get_forum_post->fetchAll();

	$forum_posts = "";

	foreach ($data as $row) {
		$chat_id_from_db = $row["chat_id"];
		$username_from_db = $row["username"];
		$log_date_from_db = $row["log_date"];
		$text_content_from_db = $row["text_content"];
		$reply_val_from_db = $row["reply_to"];

		$log_time = substr($log_date_from_db, 11, 5);
		$log_date = substr($log_date_from_db, 5, 2) ."/". substr($log_date_from_db, 8, 2) ."/". substr($log_date_from_db, 2, 2);

		$html_chat_box = "<div class='forum_box";

		if (!$reply_val_from_db == null) {
			$html_chat_box .= " reply";
		}

		$html_chat_box .= "' id='chat_box_$chat_id_from_db'>
			<div class='forum_box_details'> 
				<h3>$username_from_db</h3>
				<p>&nbsp@ $log_time</p>
				<p class='date'>$log_date</p>
			</div>
			<p class='text_content'>$text_content_from_db</p>
			<a class='reply_link' onclick='open_reply(`$chat_id_from_db`);'>Reply</a>
		</div>
		<div id='reply_box_$chat_id_from_db' class='reply_box'>
			<form method='post'>
				<input type='hidden' name='chat_id' value='$chat_id_from_db'>
				<label for='text_box'>Add a reply to this chat:</label>
				<textarea name='text_box' type='text' id='text_box'></textarea>
				<input type='submit' name='add_chat_reply_$forum' value='Submit post'>
			</form>
		</div>";

		$forum_posts .= $html_chat_box;
	}

	return $forum_posts;
}

function add_forum_post($forum, $text_content, $reply = false, $chat_id = null) {
	global $host, $username_db, $password, $db_name;

	$add_forum_post = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
	$add_forum_post->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	if ($reply == false && $chat_id == null) {
		$sql_add_forum_post = "INSERT INTO chat_log (user_id, topic_id, text_content) VALUES (:user_id, :topic_id, :text_content)";

		$stmt_add_forum_post = $add_forum_post->prepare($sql_add_forum_post);

		$stmt_add_forum_post->execute([
			'user_id' => $_SESSION["user_id"],
			'topic_id'=> $forum,
			'text_content' => trim($_POST["text_box"])
		]);
	} else {
		$sql_add_forum_post = "INSERT INTO chat_log (user_id, topic_id, text_content, reply_to) VALUES (:user_id, :topic_id, :text_content, :reply_to)";

		$stmt_add_forum_post = $add_forum_post->prepare($sql_add_forum_post);

		$stmt_add_forum_post->execute([
			'user_id' => $_SESSION["user_id"],
			'topic_id'=> $forum,
			'text_content' => trim($_POST["text_box"]),
			'reply_to' => $chat_id
		]);
	}

}

function get_forums() {
    global $host, $username_db, $password, $db_name;

    $pdo_get_forums = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
	$pdo_get_forums->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$sql_get_forums = "SELECT topic_id, topic_name FROM topics WHERE topic_name NOT LIKE '%:topic'";
	$stmt_get_forums = $pdo_get_forums->prepare($sql_get_forums);
	$stmt_get_forums->execute();

	$stmt_get_forums->setFetchMode(PDO::FETCH_ASSOC);

	$data = $stmt_get_forums->fetchAll();
    $forums = array();

    foreach ($data as $data_element) {
        $forums[] = $data_element;
    }

    return $forums;
}

$forums = get_forums();

for ($i = 0; $i < sizeof($forums); $i++) {
    if (isset($_POST[$forums[$i]["topic_name"] . "_add_post"])) {
    	if (!empty($_POST["text_box"])) {
    		add_forum_post($forums[$i]["topic_id"], $_POST["text_box"]);
    	}
    }
}

for ($j = 0; $j < sizeof($forums); $j++) {
	$post_val = "add_chat_reply_" . $forums[$j]["topic_name"];

	if (isset($_POST[$post_val])) {
		if (!empty($_POST["text_box"])) {
			add_forum_post($forums[$j]["topic_id"], $_POST["text_box"], true, $_POST["chat_id"]);
		}
	}
}

?>