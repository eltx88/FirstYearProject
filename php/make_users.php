<?php

require("../config.php");

$pdo = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$firstnames = array("Adam", "Alex", "Aaron", "Ben", "Carl", "Dan", "David", "Edward", "Fred", "Frank", "George", "Hal", "Hank", "Ike", "John", "Jack", "Joe", "Larry", "Monte", "Matthew", "Mark", "Nathan", "Otto", "Paul", "Peter", "Roger", "Roger", "Steve", "Thomas", "Tim", "Ty", "Victor", "Walter");

$lastnames = array("Anderson", "Ashwoon", "Aikin", "Bateman", "Bongard", "Bowers", "Boyd", "Cannon", "Cast", "Deitz", "Dewalt", "Ebner", "Frick", "Hancock", "Haworth", "Hesch", "Hoffman", "Kassing", "Knutson", "Lawless", "Lawicki", "Mccord", "McCormack", "Miller", "Myers", "Nugent", "Ortiz", "Orwig", "Ory", "Paiser", "Pak", "Pettigrew", "Quinn", "Quizoz", "Ramachandran", "Resnick", "Sagar", "Schickowski", "Schiebel", "Sellon", "Severson", "Shaffer", "Solberg", "Soloman", "Sonderling", "Soukup", "Soulis", "Stahl", "Sweeney", "Tandy", "Trebil", "Trusela", "Trussel", "Turco", "Uddin", "Uflan", "Ulrich", "Upson", "Vader", "Vail", "Valente", "Van Zandt", "Vanderpoel", "Ventotla", "Vogal", "Wagle", "Wagner", "Wakefield", "Weinstein", "Weiss", "Woo", "Yang", "Yates", "Yocum", "Zeaser", "Zeller", "Ziegler", "Bauer", "Baxster", "Casal", "Cataldi", "Caswell", "Celedon", "Chambers", "Chapman", "Christensen", "Darnell", "Davidson", "Davis", "DeLorenzo", "Dinkins", "Doran", "Dugelman", "Dugan", "Duffman", "Eastman", "Ferro", "Ferry", "Fletcher", "Fietzer", "Hylan", "Hydinger", "Illingsworth", "Ingram", "Irwin", "Jagtap", "Jenson", "Johnson", "Johnsen", "Jones", "Jurgenson", "Kalleg", "Kaskel", "Keller", "Leisinger", "LePage", "Lewis", "Linde", "Lulloff", "Maki", "Martin", "McGinnis", "Mills", "Moody", "Moore", "Napier", "Nelson", "Norquist", "Nuttle", "Olson", "Ostrander", "Reamer", "Reardon", "Reyes", "Rice", "Ripka", "Roberts", "Rogers", "Root", "Sandstrom", "Sawyer", "Schlicht", "Schmitt", "Schwager", "Schutz", "Schuster", "Tapia", "Thompson", "Tiernan", "Tisler");

$courses = array("accounting","actuarial Science and Mathematics","adult Nursing","aerospace Engineering","american Studies","anatomical Sciences","ancient History","arabic Studies","archaeology","architecture","art History","biochemistry","biology","biomedical Sciences","biotechnology","cell Biology","chemical Engineering","chemistry","children's Nursing","chinese Studies","civil Engineering","classical Studies","cognitive Neuroscience and Psychology","comparative Religion and Social Anthropology","computer Science","criminology","dental Hygiene and Therapy ","dentistry","developmental Biology","development Studies Econ","drama","earth and Planetary Sciences","east Asian Studies","economics","education","educational Psychology","egyptology","electrical, Electronic & Mechatronic Engineerin","electronic Engineering ","english Language","english Literature","environmental Management","environmental Science","fashion Buying and Merchandising","fashion Management","fashion Marketing","fashion Technology","film Studies","finance Econ","french Studies","genetics","geography","geography","german Studies","history","history  of Art","immunology","information Technology Management for Business","international Business, Finance and Economic ","international Disaster Management & Humanitaria","international Management","law","liberal Arts","life Sciences","linguistics","languages","management","materials Science and Engineering","mathematics","mechanical Engineering","mechatronic Engineering","medical Biochemistry","medical Physiology","medicine","mental Health Nursing ","microbiology","middle Eastern Studies","modern History and Politics","modern History with Economics","modern Language and Business & Management","molecular Biology","music","music and Drama","neuroscience","optometry","oral Health Science","pharmacology","philosophy","physics","plant Science","politics, Philosophy and Economics","psychology","religions", "Theology and Ethics","russian Studies","social Anthropology","sociology","speech and Language Therapy","theological Studies in Philosophy and Ethics","zoology");

$accommodations = array("ashburne Hall","brook Hall","burkhardt House","canterbury Court","dalton-Ellis Hall","denmark Road","george Kenyon Hall","horniman House","hulme Hall","oak House","richmond Park","rusholme Place","sheavyn House","st Anselm Hall","unsworth Park","uttley House","weston Hall","whitworth Park","wilmslow Park","woolton Hall");

$nationlities = array("afghan","albanian","algerian","american","andorran","angolan","antiguans","argentinean","armenian","australian","austrian","azerbaijani","bahamian","bahraini","bangladeshi","barbadian","barbudans","batswana","belarusian","belgian","belizean","beninese","bhutanese","bolivian","bosnian","brazilian","british","bruneian","bulgarian","burkinabe","burmese","burundian","cambodian","cameroonian","canadian","cape verdean","central african","chadian","chilean","chinese","colombian","comoran","congolese","costa rican","croatian","cuban","cypriot","czech","danish","djibouti","dominican","dutch","east timorese","ecuadorean","egyptian","emirian","equatorial guinean","eritrean","estonian","ethiopian","fijian","filipino","finnish","french","gabonese","gambian","georgian","german","ghanaian","greek","grenadian","guatemalan","guinea-bissauan","guinean","guyanese","haitian","herzegovinian","honduran","hungarian","icelander","indian","indonesian","iranian","iraqi","irish","israeli","italian","ivorian","jamaican","japanese","jordanian","kazakhstani","kenyan","kittian and nevisian","kuwaiti","kyrgyz","laotian","latvian","lebanese","liberian","libyan","liechtensteiner","lithuanian","luxembourger","macedonian","malagasy","malawian","malaysian","maldivan","malian","maltese","marshallese","mauritanian","mauritian","mexican","micronesian","moldovan","monacan","mongolian","moroccan","mosotho","motswana","mozambican","namibian","nauruan","nepalese","new zealander","ni-vanuatu","nicaraguan","nigerien","north korean","northern irish","norwegian","omani","pakistani","palauan","panamanian","papua new guinean","paraguayan","peruvian","polish","portuguese","qatari","romanian","russian","rwandan","saint lucian","salvadoran","samoan","san marinese","sao tomean","saudi","scottish","senegalese","serbian","seychellois","sierra leonean","singaporean","slovakian","slovenian","solomon islander","somali","south african","south korean","spanish","sri lankan","sudanese","surinamer","swazi","swedish","swiss","syrian","taiwanese","tajik","tanzanian","thai","togolese","tongan","trinidadian or tobagonian","tunisian","turkish","tuvaluan","ugandan","ukrainian","uruguayan","uzbekistani","venezuelan","vietnamese","welsh","yemenite","zambian","zimbabwean");

for ($i = 0; $i < 250; $i++) {
	$firstname = $firstnames[random_int(0, sizeOf($firstnames)-1)];
	$lastname = $lastnames[random_int(0, sizeOf($lastnames)-1)];

	$username = $firstname . "_" . $lastname . random_int(1,100);

	$password = "password";

	$hobbies = "";
	$hobby_vals = array();
	for ($j = 0; $j < random_int(1, 5); $j++) {
		$hobby_val = random_int(1,16);

		while (in_array($hobby_val, $hobby_vals)) {
			$hobby_val = random_int(1,16);
		}

		$hobby_vals[] = $hobby_val;

		$hobbies .= $hobby_val . ",";
	}

	$hobbies = substr($hobbies, 0, -1);

	$email_address = $username . "@gmail.com";

	$accommodation = $accommodations[random_int(0, sizeof($accommodations)-1)];
	$course = $courses[random_int(0, sizeof($courses))];
	$nationality = $nationlities[random_int(0, sizeof($nationlities)-1)];
	$bio = "Hey, my name is $firstname $lastname, I am studying $course, and I am going to live at $accommodation. Any fellow " . $nationality . "s want to meet up?";

	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	$sql_join = "INSERT INTO user_info (username, firstname, lastname, hashed_password, email_address, nationality, course, accommodation, biography, private_account, hobbies) VALUES (:username, :firstname, :lastname, :hashed_password, :email_address, :nationality, :course, :accommodation, :biography, :private_account, :hobbies)";

	$stmt_join = $pdo->prepare($sql_join);
	$stmt_join->execute([
		'username' => $username,
		'firstname' => $firstname,
		'lastname' => $lastname,
		'hashed_password' => $hashed_password,
		'email_address' => $email_address,
		'nationality' => $nationality,
		'course' => $course,
		'accommodation' => $accommodation,
		'biography' => $bio,
		'private_account' => 0,
		'hobbies' => $hobbies,
	]);

	if ($i == 249) {
		break;
	}
}

?>