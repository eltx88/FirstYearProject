<?php


// duplicate of get_topics function from chat_functions but i need it to reload the topics
function get_topics_duplicate() {
	global $host, $username_db, $password, $db_name, $rand;

	$pdo_get_topics = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
	$pdo_get_topics->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

	$sql_get_topics = "SELECT topic_id, topic_name FROM topics WHERE topic_name LIKE '%:topic'";

	$stmt_get_topic = $pdo_get_topics->prepare($sql_get_topics);

	$stmt_get_topic->execute();

	$data = $stmt_get_topic->fetchAll();
	$topics = array();

	foreach($data as $data_element) {
		$topics[] = array(
			"id" => $data_element["topic_id"],
			"topic" => str_replace(":topic", "", $data_element["topic_name"])
		);		
	}
	return $topics;
}	

// added for loop for adding data to the database on the topics
$topics = get_topics_duplicate();

for ($k = 0; $k < sizeof($topics); $k++) {
	$add_val_topics = "add_chat_topic_" . $topics[$k]["topic"];

	if (isset($_POST[$add_val_topics])) {
		if (!empty($_POST["text_box"])) {
			$js_parameter = $topics[$k]["topic"] . "_topic";
			echo "<script>open_topic('$js_parameter');</script>";
		}
	}
}

// added for loop for adding replies to the database
for ($l = 0; $l < sizeof($topics); $l++) {
	$add_reply_topics = "add_chat_reply_" . $topics[$l]["topic"];

	if (isset($_POST[$add_reply_topics])) {
		if (!empty($_POST["text_box"])) {
			$js_parameter = $topics[$l]["topic"] . "_topic";
			echo "<script>open_topic('$js_parameter');</script>";
		}
	}	
}

?>