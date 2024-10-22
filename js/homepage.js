$(document).ready(function(){
$(".checkbox__input").on('click', function(){
	
	
	var value = $(this).val();
	
		$.ajax({
			url: "php/homepage_update_info.php",
			type: "POST",
			data:{"task":value}
			});
		  
			if($(this).prop("checked") == true)
			{
				
				$("#" + value).css("background-color", '#fbb66d');
				
			}else if($(this).prop("checked") == false)
			{
				
				$("#" + value).css('background-color', "#fddbb7");				
				//document.getElementById(value).style.backgroundColor = "#fddbb7";
			}
	});

document.querySelector('.close').addEventListener('click', function(){
	document.querySelector('.modal_container').style.display='none';

});
});

function tooltip_activation() {
	var tooltips = document.getElementsByClassName("tooltip");
	
	for (var i = 0; i < tooltips.length; i++) {
		if (document.querySelector(".sidebar").classList.value == "sidebar active") {
			tooltips[i].style.display = "none";
		} else {
			tooltips[i].style.display = "block";
		}
	}
}

window.onload = function(){ 
    let btn = document.querySelector("#btn");
	let sidebar = document.querySelector(".sidebar");
	let current_content = document.querySelector("#current_content");

	btn.onclick = function(){
		sidebar.classList.toggle("active");
		current_content.classList.toggle("active");
		tooltip_activation();

		var sections = document.getElementById("nav_list").children;
		var section_ids = [];

		for (var i = 0; i < sections.length; i++) {
			section_ids.push(sections[i].id);
		}

		for (var j = 0; j < section_ids.length; j++) {
			if(document.getElementsByClassName("sidebar")[0].classList.value == "sidebar active") {
				console.log("sidebar active, trying to make the label background colour");
				if (document.getElementById(section_ids[j]).children[0].children[0].style.backgroundColor == 'rgb(99, 180, 207)') {

					document.getElementById(section_ids[j]).style.backgroundColor = "#63B4CF";
				}
			} else {
				document.getElementById(section_ids[j]).style.backgroundColor = "#202A45";
			}
		}
	}

	window.in_progress =  new progressBar(document.querySelector('.progress'),0);
	var checked_checkboxes = document.querySelectorAll('input[type="checkbox"]:checked').length;
	window.in_progress.setValue(checked_checkboxes * 10);

	
}

function open_content(section) {
	
	var sections = document.getElementById("nav_list").children;
	var section_ids = [];

	for (var i = 0; i < sections.length; i++) {
		section_ids.push(sections[i].id);
	}

	var prefix = "content_";
	for (var j = 0; j < section_ids.length; j++) {
		if (section_ids[j] != section) {
			document.getElementById(prefix + section_ids[j]).style.display = "none";
			console.log(document.getElementsByClassName("sidebar")[0].classList.value);
			if (document.getElementsByClassName("sidebar")[0].classList.value == "sidebar active") {
				document.getElementById(section_ids[j]).style.backgroundColor = "#202A45";
				document.getElementById(section_ids[j]).children[0].children[0].style.backgroundColor = "#202A45";
			} else {
				document.getElementById(section_ids[j]).children[0].children[0].style.backgroundColor = "#202A45";
			} 
		} else {
			document.getElementById(prefix + section_ids[j]).style.display = "block";
			document.getElementById('progress_bar').style.display = "flex";

			if (document.getElementsByClassName("sidebar")[0].classList.value == "sidebar active") {
				document.getElementById(section_ids[j]).style.backgroundColor = "#63B4CF"
				document.getElementById(section_ids[j]).children[0].children[0].style.backgroundColor = "#63B4CF";
			} else {
				document.getElementById(section_ids[j]).children[0].children[0].style.backgroundColor = "#63B4CF";
			}
		}
	}
}

class progressBar{
	constructor(element, initialValue = 0){
		this.valueElem = element.querySelector('.progress_value');
		this.fillElem = element.querySelector('.progress_fill');

		this.setValue(initialValue);
	}

	setValue(newValue){
		if (newValue < 0){
			newValue = 0;
		}
		if (newValue > 100){
			newValue = 100;
		}
		this.value = newValue;
		this.update();
	}

	update_value(id){
		let cb = document.getElementById('content_' + id).querySelector('#check_' + id);
		var checkbox = document.getElementsByClassName('checkbox');
		var dict = {
			'gp': 0,
			'bank': 1,
			'accommodation': 2,
			'brp': 3,
			'police': 4,
			'studentid': 5,
			'society': 6,
			'tour_campus': 7,
			'blackboard_setup': 8,
			'tuition_fees': 9,
		  };

		if (cb.checked){
			this.value +=10;
			console.log(cb.checked);
			checkbox[dict[id]].style.backgroundColor = "#63B4CF";
			checkbox[dict[id]].innerText = "Undone";
			console.log(cb.checked);

		}
		else if (!cb.checked){
			this.value -=10;
			checkbox[dict[id]].style.backgroundColor = "#202A45";
			checkbox[dict[id]].innerText = "Done";
			console.log(cb.checked);
		}

		this.update();
	}

	// update(){
	// 	this.fillElem.style.width = (this.value / 10) + "em";
	// 	this.valueElem.textContent = this.value + '%';
	// }
		update(){
			const precentage = this.value + '%';
			this.fillElem.style.width = (this.value/2) + 'em';
			this.valueElem.textContent = precentage;
			let tasks = (100 - this.value) / 10;

			if (tasks == 1 ) {
				document.getElementById("task_remaining").innerText = tasks + " task left to be completed";
			} else {
				document.getElementById("task_remaining").innerText = tasks + " tasks left to be completed";
			}
			
			
			if (this.value == 100){
				document.getElementById('modal_container').style.display = 'inherit';
			}
			else{
				document.getElementById('modal_container').style.display = 'hidden';
			}
		}
}
