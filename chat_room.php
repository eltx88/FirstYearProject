<!-- 
The chat room page of our first year group project from tutorial group Z7
Coded by: Amy Leigh-Hyer, Daniel Dobzinski, Euan Liew, Frenciel Anggi, Sarah Almuhaythif, Will Asbery, and Yuyao Chen 
!-->

<?php

require("config.php");

session_start();

// require("fake_login_init.php");

if (!isset($_SESSION["logged_in"])) {
	header("Location: index_page.php");
} else {
	require("php/chat_functions.php");
}

if (isset($_POST["logout_button"])) {
	$_SESSION = array();
	session_destroy();
	header("location: index_page.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>linkuni</title>
	<link rel="stylesheet" type="text/css" href="styling/master.css">
	<link rel="stylesheet" type="text/css" href="styling/chat_room.css">
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/chat_room.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
</head>
<body>
	<div id="navbar">
		<form method="post" id="logout_form">
			<input id="logout_button" type="submit" name="logout_button" class="navbar_button" value="Logout">
		</form>
		<a class="navbar_button" id="profile_page_link" href="profile_page.php">My Profile</a>
		<a class="navbar_button" id="chat_room_link_highlight" href="chat_room.php">Chatroom</a>
		<a class="navbar_button" id="homepage_link" href="find_friends.php">Find Friends</a>
		<a class="navbar_button" id="homepage_link" href="homepage.php">Homepage</a>

	</div>
<div id="main">
	<div class="left" id="left">
		<h1>Welcome to the chatroom!</h1>
		<a href="https://storyset.com/social-media"><!-- Social media illustrations by Storyset --><img src="images/friends.png" class="chat_pic" width="400em" height="400em"></a>
		<h2>This page is dedicated to help you communicate with other students who are in a similar situation to you!</h2>
	</div>

	<div class="right" id="right">
		<!-- <p>You can pick a topic from the list here, already created by other students, or make a new topic</p> -->
		<div id="main_content" class="main_home">
			<!-- <div id="navigation_pane" style="display:none">
				<h2>Browse topics:</h2>
				<form method="post" class="add_topic" id="add_topic">
					<textarea name="add_topic_name" type="text" id="text_area_add_topic"></textarea>
					<label class="topic_label"><i class='bx bx-plus'><input type="submit" id="create_topic_button" name="add_topic" value=""></i></label>
				</form>
				<ul id="topics_list">
					<?php
						echo display_topics();
					?>
				</ul>
			</div> -->
			<div id="current_content">
				<div id="basic_content">
					<div id="intro_content">
						<span align="center">
							<h2>You can pick a topic from the list here, already created by other students, or make a new topic here <i class='bx bx-down-arrow-alt'></i></h2>
							<form method="post" class="add_topic add_topic_intro">
								<textarea name="add_topic_name" type="text" id="text_area_add_topic"></textarea>
								<input type="submit" name="add_topic" value="+" >
							</form>
							<!-- <hr> -->
						</span>

						<div class="choose_topic">
							<h3>Available Topics</h3>

							<div id="topics_table_div">
								<div class="table_content">
								
								<?php
									echo display_topic_table();
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div class="chat_page" id="chat_page">
		<div class="box1">
			<div id="navigation_pane">
				<form method="post" class="add_topic" id="add_topic">
					<textarea name="add_topic_name" type="text" id="text_area_add_topic" placeholder="Add new topic..."></textarea>
					<input type="submit" id="create_topic_button" name="add_topic" value="+" >
				</form>
				<h2>Browse topics:</h2>
				<ul id="topics_list">
					<?php
						echo display_topics();
					?>
				</ul>
			</div>		</div>
		<div class="box2">

			<?php
				 echo display_content_divs();
			?>
		</div>
	</div>
</div>
<?php
	include("php/reopen_content.php");
?>
<div id="footer">
		<div class="footer_container">
			<div class="row">
				<div class="footer_col">
					<h4>z7</h4>
					<ul>
						<li><a href="#"><img src="images/linkuni_logo_white.png" class="logo_footer"></a></li>
						<!-- <li><a href="#">z7</a></li> -->
					</ul>
				</div>
				<div class="footer_col">
					<h4>Need help?</h4>
					<ul>
						<li><a href="#">william.asbery@student.manchester.ac.uk</a></li>
						<li><a href="#">daniel.dobzinski@student.manchester.ac.uk</a></li>
						<li><a href="#">frenciel.anggi@student.manchester.ac.uk</a></li>
					</ul>
				</div>
				<div class="footer_col">
					<h4>Any suggestions</h4>
					<ul>
						<li><a href="#">sarah.almuhaythif@student.manchester.ac.uk</a></li>
						<li><a href="#">amy.leigh-hyer@student.manchester.ac.uk</a></li>
						<li><a href="#">euan.liew@student.manchester.ac.uk</a></li>
						<li><a href="#">yuyao.chen@student.manchester.ac.uk</a></li>
					</ul>
				</div>
				<div class="footer_col">
					<h4>Follow us</h4>
					<div class="social_links">
						<a href="#"><i class='bx bxl-instagram'></i></a>
						<a href="#"><i class='bx bxl-twitter'></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
