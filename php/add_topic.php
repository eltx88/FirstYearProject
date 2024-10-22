<?php

require("../config.php");
require("chat_functions.php");

if (isset($_POST)) {
	$topic_name = $_POST["text_area_add_topic"];

	add_topic($topic_name);
}

?>