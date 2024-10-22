<!-- The main index page of our first year group project from tutorial Group Z7 -->
<!-- Coded by: Amy Leigh-Hyer, Daniel Dobzinski, Euan Liew, Frenciel Anggi, Sarah Almuhaythif, Will Asbery, and Yuyao Chen -->

<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

require("config.php");

require("php/login.php");
require("php/join.php");

?>

<!-- 
Please can you use snake case, so for two words like 'hello world' make the variable hello_word, cheersss
Also when you're adding images please can you use an alt tag just in case the image doesn't load -
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>linkuni</title>
	<link rel="stylesheet" type="text/css" href="styling/master.css">
	<link rel="stylesheet" type="text/css" href="styling/index_page.css">
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<script type="text/javascript" src="js/index_page.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
</head>
<body onload="check_modals();">

	<div id="main">
		<div id="main_content" align="center">
			<!-- This is the main page so here we can include the explanation of linkuni and then the join button -->

			<!-- Can insert an image here of the logo -->
			<img class="logo_image" src="images/linkuni_logo_blue.png" alt="Logo image">

			<div id="main_information" class="bg_animation">
				<ul id="info_list">
					<li>
						<a id="animation1"><b>What is linkuni about?</b></a>
					</li>
					<li>
						<a id="animation2" class="supp_text">Linkuni is a social platform which aims to connect prospective University of Manchester students from across the globe. Use it to make sure you are prepared for University life, and to connect with people in a similar situation to you!</a>
					</li>
					<li>
						<a id="animation3"><b>Features of the site include</b></a>
					</li>
					<li>
						<a id="animation4" class="supp_text">A to-do-list to ensure a smooth transition into university life;</a>
					</li>
					<li>
						<a id="animation5" class="supp_text">Customisable profile page;</a>
					</li>
					<li>
						<a id="animation6" class="supp_text">The ability to search for people who are on similar courses, in the same accommodation as you, or who share the same interests as you;</a>
					</li>
					<li>
						<a id="animation7" class="supp_text">A chat room where you can communicate with anyone, about anything.</a>
					</li>
				</ul>
			</div>

			<div id="join_area">
				<div id="left_side">
					<h2>Get started</h2>
					<button id="join_button" onclick="toggle_modal('join');">Join</button>
				</div>
				<div id="right_side">
					<h2>Already got an account?</h2>
					<button id="login_button" onclick="toggle_modal(`login`);">Login</button>
			</div>


			<div id="join_modal" class="modal" align="left">
				<div class="modal_content modal_animate">
					<form method="post" autocomplete="new-password">
						<p onclick="toggle_modal('join');" class="close" title="join_modal_close">&times;</p>

						<h3>Join</h3>

						<?php
						if (isset($error_message_join)) {
							echo "<label class='error_message' for='join'>" .$error_message_join . "</label>";
						}
						?>

						<label for="username_join">Username</label>
						<input type="text" name="username_join" placeholder="Enter your username:" autocomplete="off">

						<label for="email_join">Email</label>
						<input type="text" name="email_join" placeholder="Enter your email:" autocomplete="off">

						<label for="password_join">Password:</label>
						<input type="password" name="password_join" placeholder="Enter your password:" autocomplete="off">

						<label for="password_confirm_join">Confirm your password:</label>
						<input type="password" name="password_confirm_join" placeholder="Confirm your password:" autocomplete="off">

						<input type="submit" name="join_button" value="Join"><br>
					</form>
				</div>
			</div>

			<div id="login_modal" class="modal">
				<div class="modal_content modal_animate">
					<form method="post" autocomplete="new-password">
						<p onclick="toggle_modal('login');" class="close" title="login_modal_close">&times;</p>

						<h3>Login</h3>
						
						<?php
						if (isset($error_message_login)) {
							echo "<label class='error_message' for='login'>" .$error_message_login . "</label>";
						}
						?>

						<label for="username_login">Username / email:</label>
						<input type="text" name="username_login" placeholder="Enter your username:" autocomplete="off">

						<label for="password_login">Password:</label>
						<input type="password" name="password_login" placeholder="Enter your password:" autocomplete="off">
						<!-- <a href="forgot_password.php">Forgot your password?</a> -->

						<input type="submit" value="Login" name="login_button">
					</form>
				</div>
			</div>
		</div>
	</div>

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

	<script type="text/javascript">
		clear_inputs();
	</script>
</body>
</html>
