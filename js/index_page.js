window.onclick = function(event) {
	var current_location = event.target;

	if (document.getElementById("login_modal")) {
		if (document.getElementById("login_modal").style.display == "block") {
			if (current_location.id != "modal_content" & current_location.id != "login_button" & current_location.id == "login_modal") {
				while (current_location.class !== "modal") {
					current_location = current_location.parentElement;

					if (current_location == null) {
						document.getElementById("login_modal").style.display = "none";
						break;
					}
				}
			}
		}
	}
	
	if (document.getElementById("join_modal")) {
		if (document.getElementById("join_modal").style.display == "block") {
			if (current_location.id != "modal_content" & current_location.id != "join_button" & current_location.id == "join_modal") {
				while (current_location.class !== "modal") {
					current_location = current_location.parentElement;

					if (current_location == null) {
						document.getElementById("join_modal").style.display = "none";
						break;
					}
				}
			}
		}
	}

	if (document.getElementById("hobbies_modal")) {
		if (document.getElementById("hobbies_modal").style.display == "block") {
			if (current_location.id != "modal_content_hobbies" & current_location.id == "hobbies_modal") {
				while (current_location.class !== "modal") {
					current_location = current_location.parentElement;

					if (current_location == null) {
						document.getElementById("hobbies_modal").style.display = "none";
						break;
					}
				}
			}
		}
	}
}

function toggle_modal(modal_name) {
	var modal_status = document.getElementById(modal_name + "_modal");
	
	if (modal_status.style.display == "none" | modal_status.style.display == "") {
		modal_status.style.display = "block";
	} else {
		modal_status.style.display = "none";
	}
}

function open_content(section) {
	var current = document.getElementById(section + "_content");
	var sections = ["gp_signup", "bank_signup", "find_accommodation", "BRP_card_collection", "student_id"]

	for (i = 0; i < sections.length; i++) {
		if (section != sections[i]) {
			document.getElementById(sections[i] + "_content").style.display = "none";
			document.getElementById(sections[i]).style.backgroundColor = "white";
			document.getElementById(sections[i]).children[0].style.color = "black";
		} else {
			current.style.display = "block";
			document.getElementById(sections[i]).style.backgroundColor = "#63B4CF";
			document.getElementById(sections[i]).children[0].style.color = "white";
		}
	}
}

function check_modals() {
	if (document.getElementsByClassName("error_message")) {
		var error_messages = document.getElementsByClassName("error_message");
		var for_value = error_messages[0].getAttribute('for');

		if (for_value == "join") {
			return document.getElementById("join_modal").style.display = "block";
		} else if (for_value == "login") {
			return document.getElementById("login_modal").style.display = "block";
		}
	}
}

function open_topic(section) {
	document.getElementById("basic_content").style.display = "none";

	var current = document.getElementById(section + "_content");
	var sections = ["gp_topic", "brp_topic"];

	for (i = 0; i < sections.length; i++) {
		if (section != sections[i]) {
			document.getElementById(sections[i] + "_content").style.display = "none";
			document.getElementById(sections[i]).style.backgroundColor = "white";
			document.getElementById(sections[i]).children[0].style.color = "black";
		} else {
			current.style.display = "block";
			document.getElementById(sections[i]).style.backgroundColor = "#63B4CF";
			document.getElementById(sections[i]).children[0].style.color = "white";
		}
	}
}

function open_reply(chat_id) {
	document.getElementById("reply_box_" + chat_id).style.display = "block";
}

function clear_inputs() {
    inputs = document.getElementsByTagName('input');

    console.log(inputs);

    for (var i = 0; i < inputs.length; i++) {
    	inputs[i].value('');
    }
}