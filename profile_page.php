<!-- 
The profile page of our first year group project from tutorial group Z7
Coded by: Amy Leigh-Hyer, Daniel Dobzinski, Euan Liew, Frenciel Anggi, Sarah Almuhaythif, Will Asbery, and Yuyao Chen 
!-->

<?php

session_start();

require("config.php");

if (!isset($_SESSION["logged_in"])) {
	header("Location: index_page.php");
} else {
}

// get all the information on the user
require("php/get_hobbies.php");
require("php/profile_page_init.php");
require("php/profile_page_update_info.php");	


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
	<link rel="stylesheet" type="text/css" href="styling/master.css"></link>
	<link rel="stylesheet" type="text/css" href="styling/profile_page.css"></link>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<script type="text/javascript" src="js/profile_page.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
</head>
<body>
	
	<div id="main">
		
	<div id="navbar">
		<form method="post" id="logout_form">
			<input id="logout_button" type="submit" name="logout_button" class="navbar_button" value="Logout">
		</form>
		<a class="navbar_button" id="profile_page_link_highlight" href="profile_page.php">My Profile</a>
		<a class="navbar_button" id="chat_room_link" href="chat_room.php">Chatroom</a>
		<a class="navbar_button" id="homepage_link" href="find_friends.php">Find Friends</a>
		<a class="navbar_button" id="homepage_link" href="homepage.php">Homepage</a>

	</div>
	<form method="post" id="change_profile_form">
		<div class="container">
			<div class="left_box">
				<nav style="margin-top: 5m;">
					<a onclick="tabs(0)" id="main_profile" class="tab active">
						<i class='bx bxs-user'></i>
						<p>Main profile information.</p>
					</a>
					<a onclick="tabs(1)" id="changes" class="tab">
						<i class='bx bx-book-content'></i>
						<p>Change your biography, course and accommodation.</p>
					</a>
					<!-- <a onclick="tabs(2)" class="tab">
						<i class='bx bx-question-mark' ></i>
						<p>keep/delete</p>
					</a> -->
				</nav>
			</div>
			<div class="right_box">
				<div class="profile tabShow" id="profile">
					<h1>Personal Information</h1>
					<?php 
					if (isset($email_address_error)) {
						echo "<label for='email_address' class='profile_page_error'>Invalid email address.</label><br>";
					} else {
						echo '<label for="email_address">Email:</label><br>';
					}
					?>
					<input name="email_address" type="text" value="<?php echo $data['email_address'] ?>"><br>

					<?php 
					if (isset($firstname_error)) {
						echo "<label for='firstname' class='profile_page_error'>Invalid firstname.</label><br>";
					} else {
						echo '<label for="firstname">Firstname:</label><br>';
					}
					?>
					<input name="firstname" type="text" value="<?php echo $data['firstname'] ?>"><br>

					<?php 
					if (isset($lastname_error)) {
						echo "<label for='lastname' class='profile_page_error'>Invalid lastname.</label><br>";
					} else {
						echo '<label for="lastname">Lastname:</label><br>';
					}
					?>
					<input name="lastname" type="text" value="<?php echo $data['lastname'] ?>"><br>

					<?php 
					if (isset($phone_number_error)) {
						echo "<label for='phone_number' class='profile_page_error'>Invalid phone number format.</label><br>";
					} else {
						echo '<label for="phone_number">Phone number:</label><br>';
					}
					?>
					<input name="phone_number" type="text" value="<?php echo $data['phone_number'] ?>"><br>

					<label for="nationality">Nationality:</label><br>
					<!-- This code is taken from https://gist.github.com/didats/8154290 !-->
					<select name="nationality">
						<option value="<?php echo $data['nationality'] ?>" selected>
							<?php 
								if ($data["nationality"] == "") {
									echo "Choose here";
								} else {
									echo ucwords($data["nationality"]);
								} 
							?>
						</option>
						<option value="afghan">Afghan</option>
						<option value="albanian">Albanian</option>
						<option value="algerian">Algerian</option>
						<option value="american">American</option>
						<option value="andorran">Andorran</option>
						<option value="angolan">Angolan</option>
						<option value="antiguans">Antiguans</option>
						<option value="argentinean">Argentinean</option>
						<option value="armenian">Armenian</option>
						<option value="australian">Australian</option>
						<option value="austrian">Austrian</option>
						<option value="azerbaijani">Azerbaijani</option>
						<option value="bahamian">Bahamian</option>
						<option value="bahraini">Bahraini</option>
						<option value="bangladeshi">Bangladeshi</option>
						<option value="barbadian">Barbadian</option>
						<option value="barbudans">Barbudans</option>
						<option value="batswana">Batswana</option>
						<option value="belarusian">Belarusian</option>
						<option value="belgian">Belgian</option>
						<option value="belizean">Belizean</option>
						<option value="beninese">Beninese</option>
						<option value="bhutanese">Bhutanese</option>
						<option value="bolivian">Bolivian</option>
						<option value="bosnian">Bosnian</option>
						<option value="brazilian">Brazilian</option>
						<option value="british">British</option>
						<option value="bruneian">Bruneian</option>
						<option value="bulgarian">Bulgarian</option>
						<option value="burkinabe">Burkinabe</option>
						<option value="burmese">Burmese</option>
						<option value="burundian">Burundian</option>
						<option value="cambodian">Cambodian</option>
						<option value="cameroonian">Cameroonian</option>
						<option value="canadian">Canadian</option>
						<option value="cape verdean">Cape Verdean</option>
						<option value="central african">Central African</option>
						<option value="chadian">Chadian</option>
						<option value="chilean">Chilean</option>
						<option value="chinese">Chinese</option>
						<option value="colombian">Colombian</option>
						<option value="comoran">Comoran</option>
						<option value="congolese">Congolese</option>
						<option value="costa rican">Costa Rican</option>
						<option value="croatian">Croatian</option>
						<option value="cuban">Cuban</option>
						<option value="cypriot">Cypriot</option>
						<option value="czech">Czech</option>
						<option value="danish">Danish</option>
						<option value="djibouti">Djibouti</option>
						<option value="dominican">Dominican</option>
						<option value="dutch">Dutch</option>
						<option value="east timorese">East Timorese</option>
						<option value="ecuadorean">Ecuadorean</option>
						<option value="egyptian">Egyptian</option>
						<option value="emirian">Emirian</option>
						<option value="equatorial guinean">Equatorial Guinean</option>
						<option value="eritrean">Eritrean</option>
						<option value="estonian">Estonian</option>
						<option value="ethiopian">Ethiopian</option>
						<option value="fijian">Fijian</option>
						<option value="filipino">Filipino</option>
						<option value="finnish">Finnish</option>
						<option value="french">French</option>
						<option value="gabonese">Gabonese</option>
						<option value="gambian">Gambian</option>
						<option value="georgian">Georgian</option>
						<option value="german">German</option>
						<option value="ghanaian">Ghanaian</option>
						<option value="greek">Greek</option>
						<option value="grenadian">Grenadian</option>
						<option value="guatemalan">Guatemalan</option>
						<option value="guinea-bissauan">Guinea-Bissauan</option>
						<option value="guinean">Guinean</option>
						<option value="guyanese">Guyanese</option>
						<option value="haitian">Haitian</option>
						<option value="herzegovinian">Herzegovinian</option>
						<option value="honduran">Honduran</option>
						<option value="hungarian">Hungarian</option>
						<option value="icelander">Icelander</option>
						<option value="indian">Indian</option>
						<option value="indonesian">Indonesian</option>
						<option value="iranian">Iranian</option>
						<option value="iraqi">Iraqi</option>
						<option value="irish">Irish</option>
						<option value="israeli">Israeli</option>
						<option value="italian">Italian</option>
						<option value="ivorian">Ivorian</option>
						<option value="jamaican">Jamaican</option>
						<option value="japanese">Japanese</option>
						<option value="jordanian">Jordanian</option>
						<option value="kazakhstani">Kazakhstani</option>
						<option value="kenyan">Kenyan</option>
						<option value="kittian and nevisian">Kittian and Nevisian</option>
						<option value="kuwaiti">Kuwaiti</option>
						<option value="kyrgyz">Kyrgyz</option>
						<option value="laotian">Laotian</option>
						<option value="latvian">Latvian</option>
						<option value="lebanese">Lebanese</option>
						<option value="liberian">Liberian</option>
						<option value="libyan">Libyan</option>
						<option value="liechtensteiner">Liechtensteiner</option>
						<option value="lithuanian">Lithuanian</option>
						<option value="luxembourger">Luxembourger</option>
						<option value="macedonian">Macedonian</option>
						<option value="malagasy">Malagasy</option>
						<option value="malawian">Malawian</option>
						<option value="malaysian">Malaysian</option>
						<option value="maldivan">Maldivan</option>
						<option value="malian">Malian</option>
						<option value="maltese">Maltese</option>
						<option value="marshallese">Marshallese</option>
						<option value="mauritanian">Mauritanian</option>
						<option value="mauritian">Mauritian</option>
						<option value="mexican">Mexican</option>
						<option value="micronesian">Micronesian</option>
						<option value="moldovan">Moldovan</option>
						<option value="monacan">Monacan</option>
						<option value="mongolian">Mongolian</option>
						<option value="moroccan">Moroccan</option>
						<option value="mosotho">Mosotho</option>
						<option value="motswana">Motswana</option>
						<option value="mozambican">Mozambican</option>
						<option value="namibian">Namibian</option>
						<option value="nauruan">Nauruan</option>
						<option value="nepalese">Nepalese</option>
						<option value="new zealander">New Zealander</option>
						<option value="ni-vanuatu">Ni-Vanuatu</option>
						<option value="nicaraguan">Nicaraguan</option>
						<option value="nigerien">Nigerien</option>
						<option value="north korean">North Korean</option>
						<option value="northern irish">Northern Irish</option>
						<option value="norwegian">Norwegian</option>
						<option value="omani">Omani</option>
						<option value="pakistani">Pakistani</option>
						<option value="palauan">Palauan</option>
						<option value="panamanian">Panamanian</option>
						<option value="papua new guinean">Papua New Guinean</option>
						<option value="paraguayan">Paraguayan</option>
						<option value="peruvian">Peruvian</option>
						<option value="polish">Polish</option>
						<option value="portuguese">Portuguese</option>
						<option value="qatari">Qatari</option>
						<option value="romanian">Romanian</option>
						<option value="russian">Russian</option>
						<option value="rwandan">Rwandan</option>
						<option value="saint lucian">Saint Lucian</option>
						<option value="salvadoran">Salvadoran</option>
						<option value="samoan">Samoan</option>
						<option value="san marinese">San Marinese</option>
						<option value="sao tomean">Sao Tomean</option>
						<option value="saudi">Saudi</option>
						<option value="scottish">Scottish</option>
						<option value="senegalese">Senegalese</option>
						<option value="serbian">Serbian</option>
						<option value="seychellois">Seychellois</option>
						<option value="sierra leonean">Sierra Leonean</option>
						<option value="singaporean">Singaporean</option>
						<option value="slovakian">Slovakian</option>
						<option value="slovenian">Slovenian</option>
						<option value="solomon islander">Solomon Islander</option>
						<option value="somali">Somali</option>
						<option value="south african">South African</option>
						<option value="south korean">South Korean</option>
						<option value="spanish">Spanish</option>
						<option value="sri lankan">Sri Lankan</option>
						<option value="sudanese">Sudanese</option>
						<option value="surinamer">Surinamer</option>
						<option value="swazi">Swazi</option>
						<option value="swedish">Swedish</option>
						<option value="swiss">Swiss</option>
						<option value="syrian">Syrian</option>
						<option value="taiwanese">Taiwanese</option>
						<option value="tajik">Tajik</option>
						<option value="tanzanian">Tanzanian</option>
						<option value="thai">Thai</option>
						<option value="togolese">Togolese</option>
						<option value="tongan">Tongan</option>
						<option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
						<option value="tunisian">Tunisian</option>
						<option value="turkish">Turkish</option>
						<option value="tuvaluan">Tuvaluan</option>
						<option value="ugandan">Ugandan</option>
						<option value="ukrainian">Ukrainian</option>
						<option value="uruguayan">Uruguayan</option>
						<option value="uzbekistani">Uzbekistani</option>
						<option value="venezuelan">Venezuelan</option>
						<option value="vietnamese">Vietnamese</option>
						<option value="welsh">Welsh</option>
						<option value="yemenite">Yemenite</option>
						<option value="zambian">Zambian</option>
						<option value="zimbabwean">Zimbabwean</option>
					</select>
					<br>
					<input type="checkbox" name="private_account" value='1' id="private_account" <?php echo ($data['private_account'] == 1) ? 'checked="checked"' : '';?>>
					<label for="private_account">I want my account to be private, checking this means your profile does not show up on the find friends feature.</label>
					<br>
					<br>
					<input type="submit" value="Save Changes" name="save_changes_button" id="save_changes_button">

				</div>
				<div class="bio tabShow">
					<h1>Edit your course, accommodation and biography!</h1>
					<label for="course">Course:</label><br>
					<select name="course">
						<option value="<?php echo $data['course'] ?>" selected>
							<?php 
								if ($data["course"] == "") {
									echo "Choose here";
								} else {
									echo ucwords($data["course"]);
								} 
							?>
						</option>
							<option value="accounting">Accounting</option>
							<option value="actuarial Science and Mathematics">Actuarial Science and Mathematics </option>
							<option value="adult Nursing">Adult Nursing </option>
							<option value="aerospace Engineering">Aerospace Engineering</option>
							<option value="american Studies">American Studies </option>
							<option value="anatomical Sciences">Anatomical Sciences</option>
							<option value="ancient History">Ancient History </option>
							<option value="arabic Studies">Arabic Studies </option>
							<option value="archaeology">Archaeology </option>
							<option value="architecture">Architecture</option>
							<option value="art History">Art History</option>
							<option value="biochemistry">Biochemistry</option>
							<option value="biology">Biology</option>
							<option value="biomedical Sciences">Biomedical Sciences</option>
							<option value="biotechnology">Biotechnology</option>
							<option value="cell Biology">Cell Biology</option>
							<option value="chemical Engineering">Chemical Engineering </option>
							<option value="chemistry">Chemistry</option>
							<option value="children's Nursing">Children's Nursing </option>
							<option value="chinese Studies">Chinese Studies </option>
							<option value="civil Engineering">Civil Engineering </option>
							<option value="classical Studies">Classical Studies </option>
							<option value="cognitive Neuroscience and Psychology">Cognitive Neuroscience and Psychology</option>
							<option value="comparative Religion and Social Anthropology">Comparative Religion and Social Anthropology</option>
							<option value="computer Science">Computer Science </option>
							<option value="criminology">Criminology </option>
							<option value="dental Hygiene and Therapy ">Dental Hygiene and Therapy </option>
							<option value="dentistry">Dentistry</option>
							<option value="developmental Biology">Developmental Biology</option>
							<option value="development Studies Econ">Development Studies Econ </option>
							<option value="drama">Drama </option>
							<option value="earth and Planetary Sciences">Earth and Planetary Sciences</option>
							<option value="east Asian Studies">East Asian Studies </option>
							<option value="economics">Economics </option>
							<option value="education">Education </option>
							<option value="educational Psychology">Educational Psychology</option>
							<option value="egyptology">Egyptology </option>
							<option value="electrical, Electronic & Mechatronic Engineerin">Electrical, Electronic & Mechatronic Engineerin</option>g 
							<option value="electronic Engineering ">Electronic Engineering </option>
							<option value="english Language">English Language </option>
							<option value="english Literature">English Literature </option>
							<option value="environmental Management">Environmental Management</option>
							<option value="environmental Science">Environmental Science</option>
							<option value="fashion Buying and Merchandising">Fashion Buying and Merchandising </option>
							<option value="fashion Management">Fashion Management</option>
							<option value="fashion Marketing">Fashion Marketing</option>
							<option value="fashion Technology">Fashion Technology </option>
							<option value="film Studies">Film Studies </option>
							<option value="finance Econ">Finance Econ</option>
							<option value="french Studies">French Studies </option>
							<option value="genetics">Genetics</option>
							<option value="geography">Geography </option>
							<option value="geography">Geography</option>
							<option value="german Studies">German Studies </option>
							<option value="history">History </option>
							<option value="history  of Art">History of Art </option>
							<option value="immunology">Immunology</option>
							<option value="information Technology Management for Business">Information Technology Management for Business</option>
							<option value="international Business, Finance and Economic ">International Business, Finance and Economic </option>
							<option value="international Disaster Management & Humanitaria">International Disaster Management & Humanitaria</option>n Response
							<option value="international Management">International Management </option>
							<option value="law">Law </option>
							<option value="liberal Arts">Liberal Arts </option>
							<option value="life Sciences">Life Sciences</option>
							<option value="linguistics">Linguistics</option>
							<option value="languages">Languages</option>
							<option value="management">Management</option>
							<option value="materials Science and Engineering">Materials Science and Engineering</option>
							<option value="mathematics">Mathematics</option>
							<option value="mechanical Engineering">Mechanical Engineering </option>
							<option value="mechatronic Engineering">Mechatronic Engineering </option>
							<option value="medical Biochemistry">Medical Biochemistry</option>
							<option value="medical Physiology">Medical Physiology</option>
							<option value="medicine">Medicine</option>
							<option value="mental Health Nursing ">Mental Health Nursing </option>
							<option value="microbiology">Microbiology</option>
							<option value="middle Eastern Studies">Middle Eastern Studies </option>
							<option value="modern History and Politics">Modern History and Politics</option>
							<option value="modern History with Economics">Modern History with Economics </option>
							<option value="modern Language and Business & Management">Modern Language and Business & Management </option>
							<option value="molecular Biology">Molecular Biology</option>
							<option value="music">Music </option>
							<option value="music and Drama">Music and Drama </option>
							<option value="neuroscience">Neuroscience</option>
							<option value="optometry">Optometry</option>
							<option value="oral Health Science">Oral Health Science</option>
							<option value="pharmacology">Pharmacology</option>
							<option value="philosophy">Philosophy </option>
							<option value="physics">Physics</option>
							<option value="plant Science">Plant Science</option>
							<option value="politics, Philosophy and Economics">Politics, Philosophy and Economics</option>
							<option value="psychology">Psychology </option>
							<option value="religions, Theology and Ethics">Religions, Theology and Ethics </option>
							<option value="russian Studies">Russian Studies </option>
							<option value="social Anthropology">Social Anthropology</option>
							<option value="sociology">Sociology</option>		
							<option value="speech and Language Therapy">Speech and Language Therapy</option>
							<option value="theological Studies in Philosophy and Ethics">Theological Studies in Philosophy and Ethics</option>
							<option value="zoology">Zoology</option>
					</select><br>
					<input name="hobbies" onclick="toggle_modal('hobbies');" type="button" value="Click me to choose hobbies!" id="hobbies_button"><br>
					<div id="hobbies_modal" class="modal">
						<div class="modal_content modal_animate modal_content_hobbies">
							<p onclick="toggle_modal('hobbies');" class="close" title="login_modal_close">&times;</p>
									<div class='hobbies_child'>
											<!-- Hobbies checkboxes, php part checks if user had this hobby in his database, look more in get_hobbies.php-->
											<input class="hobbies_checkbox" type="checkbox" id="hobbies_sports" name='users_hobbies[]' value='1' <?php echo ($hobbies_user_array['1'] == '1') ? 'checked="checked"' : '';?>>
											<label for="hobbies_sports">Sports</label>
											
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_baking' name='users_hobbies[]' value='2' <?php echo ($hobbies_user_array['2'] == '2') ? 'checked="checked"' : '';?>> 
											<label for="hobbies_baking">Baking</label>
											
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_art' name='users_hobbies[]' value='3' <?php echo ($hobbies_user_array['3'] == '3') ? 'checked="checked"' : '';?>>
											<label for="hobbies_art">Art</label>
											
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_gaming' name='users_hobbies[]' value='4' <?php echo ($hobbies_user_array['4'] == '4') ? 'checked="checked"' : '';?>>
											<label for="hobbies_gaming">Gaming</label>
										</div>
									<div class='hobbies_child'>
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_music' name='users_hobbies[]' value='5' <?php echo ($hobbies_user_array['5'] == '5') ? 'checked="checked"' : '';?>>
											<label for="hobbies_music">Music</label>

											<input class="hobbies_checkbox" type='checkbox' id='hobbies_dance' name='users_hobbies[]' value='6' <?php echo ($hobbies_user_array['6'] == '6') ? 'checked="checked"' : '';?>>
											<label for="hobbies_dance">Dance</label>

											<input class="hobbies_checkbox" type='checkbox' id='hobbies_photography' name='users_hobbies[]' value='7' <?php echo ($hobbies_user_array['7'] == '7') ? 'checked="checked"' : '';?>>
											<label for="hobbies_photography">Photography</label>

											<input class="hobbies_checkbox" type='checkbox' id='hobbies_singing' name='users_hobbies[]' value='8' <?php echo ($hobbies_user_array['8'] == '8') ? 'checked="checked"' : '';?>>
											<label for="hobbies_singing">Singing</label>
										</div>
									<div class='hobbies_child'>
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_electronics' name='users_hobbies[]' value='9' <?php echo ($hobbies_user_array['9'] == '9') ? 'checked="checked"' : '';?>>
											<label for="hobbies_electronics">Electronics</label>

											<input class="hobbies_checkbox" type='checkbox' id='hobbies_biking' name='users_hobbies[]' value='10' <?php echo ($hobbies_user_array['10'] == '10') ? 'checked="checked"' : '';?>>
											<label for="hobbies_biking">Biking</label>

											<input class="hobbies_checkbox" type='checkbox' id='hobbies_reading' name='users_hobbies[]' value='11' <?php echo ($hobbies_user_array['11'] == '11') ? 'checked="checked"' : '';?>>
											<label for="hobbies_reading">Reading</label>
											
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_fishing' name='users_hobbies[]' value='12' <?php echo ($hobbies_user_array['12'] == '12') ? 'checked="checked"' : '';?>>
											<label for="hobbies_fishing">Fishing</label>
										</div>
									<div class='hobbies_child'>
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_traveling' name='users_hobbies[]' value='13' <?php echo ($hobbies_user_array['13'] == '13') ? 'checked="checked"' : '';?>>
											<label for="hobbies_traveling">Traveling</label>
											
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_cars' name='users_hobbies[]' value='14' <?php echo ($hobbies_user_array['14'] == '14') ? 'checked="checked"' : '';?>>
											<label for="hobbies_cars">Cars</label>
											
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_yoga' name='users_hobbies[]' value='15' <?php echo ($hobbies_user_array['15'] == '15') ? 'checked="checked"' : '';?>>
											<label for="hobbies_yoga">Yoga</label>
											
											<input class="hobbies_checkbox" type='checkbox' id='hobbies_hiking' name='users_hobbies[]' value='16' <?php echo ($hobbies_user_array['16'] == '16') ? 'checked="checked"' : '';?>>
											<label for="hobbies_hiking">Hiking</label>
										</div>
							<div> 
								<!-- This button does not do anything, just adding one to make it more intuitive -->
								<input type="button" onclick="" class="confirm_button" value="Confirm">
							</div>
						</div>
					</div>
					<!-- make a modal here !-->
					<label for="accommodation">Accommodation:</label><br>
					<select name="accommodation">
						<option value="<?php echo $data['accommodation'] ?>" selected>
							<?php 
								if ($data["accommodation"] == "") {
									echo "Choose here";
								} else {
									echo ucwords($data["accommodation"]);
								} 
							?>
						</option>
						<option value="ashburne Hall">Ashburne Hall</option>
						<option value="brook Hall">Brook Hall</option>
						<option value="burkhardt House">Burkhardt House</option>
						<option value="canterbury Court">Canterbury Court</option>
						<option value="daisy bank Hall">Daisy Bank Hall</option>
						<option value="dalton-Ellis Hall">Dalton-Ellis Hall</option>
						<option value="denmark Road">Denmark Road</option>
						<option value="george Kenyon Hall">George Kenyon Hall</option>
						<option value="horniman House">Horniman House</option>
						<option value="hulme Hall">Hulme Hall</option>
						<option value="oak House">Oak House</option>
						<option value="richmond Park">Richmond Park</option>
						<option value="rusholme Place">Rusholme Place</option>
						<option value="sheavyn House">Sheavyn House</option>
						<option value="st Anselm Hall">St Anselm Hall</option>
						<option value="unsworth Park">Unsworth Park</option>
						<option value="uttley House">Uttley House</option>
						<option value="weston Hall">Weston Hall</option>
						<option value="whitworth Park">Whitworth Park</option>
						<option value="wilmslow Park">Wilmslow Park</option>
						<option value="woolton Hall">Woolton Hall</option>
					</select><br>

					<label for="biography">Bio:</label><br>
					<textarea name="biography" type="text" id="biography"><?php echo $data['biography'] ?></textarea><br><br>
										<input type="submit" value="Save Changes" name="save_changes_button" id="save_changes_button">

				</div>
				<!-- <input type="submit" value="Save Changes" name="save_changes_button" id="save_changes_button">
			</form> -->
			</div>

		</div>

	</form>

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

<script src="jquery.js"></script>
<script>
	const tabBtn = document.querySelectorAll(".tab");
	const tab = document.querySelectorAll(".tabShow");

	function tabs(panelIndex){
		tab.forEach(function(node){
			node.style.display = "none";

		})
		tab[panelIndex].style.display = "block";

		if (panelIndex == 0) {
			document.getElementById("changes").classList.remove("active");
			document.getElementById("main_profile").classList.add("active");
		}
		else if (panelIndex == 1) {
			document.getElementById("changes").classList.add("active");
			document.getElementById("main_profile").classList.remove("active");
		}
	}
	tabs(0);
</script>
</body>
</html>