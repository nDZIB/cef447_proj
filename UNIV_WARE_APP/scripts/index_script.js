
$(document).ready(function() {
	$('form#stud_reli_dice').submit(function(event) {
		event.preventDefault();
		dice(event);
	})
})


function loadTripFromDatabase() {
	ajaxVar = ajaxOperator();

	ajaxVar.onreadystatechange = function() {
		if(ajaxVar.status == 200 && ajaxVar.readyState == 4) {

			var create = "<center><table>"
						+"<tr><th>Trip Date</th><th>Trip Time</th><th></th></tr>";


			var close = "</table></center>";
			$('#searchResults').append(ajaxVar.responseText);

			alert(ajaxVar.responseText);
		}
	}

	//ajaxVar.open("POST", '../index.php',true);
	ajaxVar.send();
}


function ajaxOperator() {

			var operationVar;
			if(window.XMLHttpRequest) {
				operationVar = new XMLHttpRequest();
			} else {
				operationVar = new ActiveXObject("Microsoft.XMLHTTP");
			}

			return operationVar;
		}


		//execute queries and put results on the page
		// window.onload =  function() {
		// 	$.get('dscripts/load_base_data.php', {called:true} , function(data) {
		// 		original_table= $('table#base_data');
		// 		results_table = $('table#operation_data');
		// 		headers = "<tr><th>Matricule</th><th>Student Name</th><th>Residence Quarter</th>"+
		// 				"<th>Average Km dist from school</th><th>Student Religion</th><th>Student Church</th>"+
		// 				"<th>Semester number</th><th>School Year</th>"+
		// 				"<th>Mark</th><th>Course Code</th><th>Course Title</th><th>Course Lecturer</th></tr>";

		// 		original_table.append(data);
		// 		results_table.append(data);
		// 	})
		// }

//function to handle roll-up operations on a relevant field
function roll_up(field) {

	$.get("./dscripts/roll_up.php", {roll_up_to:field}, function(data) {
		set_results(data);
		//hide what should be hidden
		var lowerFields =  ["ul#roll_up_list > li#"+field, "ul#drill_down_list > li#"+field];
		$("ul#roll_up_list > li").css("display", "inherit");
		$("ul#drill_down_list > li").css("display", "inherit");

		switch(field) {
			case "department":
				lowerFields.push("ul#roll_up_list > li#student");
				lowerFields.push("ul#drill_down_list > li#faculty");
				break;
			case "faculty":
				lowerFields.push("ul#roll_up_list > li#student");
				lowerFields.push("ul#roll_up_list > li#department");
				break;
			case "student":
				lowerFields.push("ul#drill_down_list > li");
				break;
			default://fields which are the least in their concept hierachy
				break;
		}
		remove(lowerFields);
	})
}

function slice(operationID) {
	$.get("./dscripts/slice.php", {dim_to_slice:operationID}, function(results) {
		set_results(results);
	})
}

function initiate_dice(operationID) {
	var dice_form="<marquee><h1>Unknown</h1></marquee>";
	switch(operationID) {
		case "student&religion":
			//show a modal box with a form where the user can specify query parameters
			//on submitting the form, the result is returned and displayed (form action could be index.php)
			$("form#stud_reli_dice").css("display", "inline");
			$("div#dialog").css("display", "inline");
			break;
		default:
			// $.get("./dscripts/dice.php", {dim_one:"student_dim", dim_two:"time_dim"}, function(results) {
			// 	set_results(results);
			// })
			alert("here we go");
			break;

	}
}

function drill_down(operationID) {
	$.get("./dscripts/roll_up.php", {roll_up_to:operationID}, function(results) {
		set_results(results);

		//hide fields which need to be hidden
		var higherFields = ["ul#drill_down_list > li#"+operationID, "ul#roll_up_list > li#"+operationID];
		$("ul#roll_up_list > li").css("display", "inherit");
		$("ul#drill_down_list > li").css("display", "inherit");
		switch(operationID) {
			case "department":
				higherFields.push("ul#drill_down_list > li#faculty");
				break;
			case "student":
				higherFields.push("ul#drill_down_list > li#department");
				higherFields.push("ul#drill_down_list > li#faculty");
			default:
				break;
		}
		remove(higherFields);
	})
}

function set_results(data) {
	tidy_up();
	results_table = $('table#operation_data').html(data);
}


function show_operation_fields(id) {
	//hide all operation lists
	tidy_up();
	$("div#"+id+" ul").css("display", "inline");
}

function hide_list(list_id) {
	$("ul#"+list_id).css("display", "none");
}

function tidy_up() {
	$("ul.operation_list").css("display", "none");
}

function show_dialog() {
	$("div#dialog").css("display", "block");
}

function remove (fields) {
	for (var count = fields.length - 1; count >= 0; count--) {
		$(fields[count]).css("display", "none");
	}
}

function show(fields) {
	for(var count = fields.length-1; count >=0; count--) {
		$(fields[count]).css("display", "inherit");
	}
}

function populate_dimension(value) {
	$("div#preview_selected_dims").append(value);
}

function display_available_fields() {
	//var selected_dims = $("input:checked");
	//var p_sltd = $.param(selected_dims);
	$.get("./dscripts/dice2.php",  function(results) {
		$("div#dialog").append(results);
	})
}

function get_dim_fields(dimension) {
	$("[value *= "+dimension+"]").hide();
	$("[value *= "+dimension+"]").parent().hide();
	$.get("./dscripts/dice2.php", {dim:dimension}, function(results) {
		$("div#prev_selected_dims").html(results);
	})
}


function select_field(field) {
	alert(field);
}

function dice(event) {
		//disable all checkboxes
		var formID = event.target.id; //each form has an id and forms are the event targets not submit buttons
	var valid = $("form#"+formID+" input[type='text']:not([disabled])");
	var requestStatus = $("form#"+formID+" input[type='radio']").serialize();
	var form="formid="+formID+"&";
	var formData = requestStatus+"&"+form+valid.serialize();
	$("form#"+formID).css("display", "none");
	$("div#dialog").css("display", "none");

	//alert(formData);

	$.ajax( {
		type : 'GET',
		url : './dscripts/dice.php',
		data: formData,
		dataType : 'json',
		encode : true
	}).done (function (results) {
		$("div#dialog").css("display", "none");
		$("div#dialog > form").css("display", "none");
		alert(results.rows);
	});
}

function updateField(fieldID) {
	var box = $("input[name="+fieldID);
	var inputField = $("input[name='"+fieldID.slice(4)+"']");

	if(box.prop("checked")) {
		inputField.attr("disabled", "disabled");
	} else {
		inputField.removeAttr("disabled");
	}
}
