window.onclick = function(event) {
	var current_location = event.target;

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