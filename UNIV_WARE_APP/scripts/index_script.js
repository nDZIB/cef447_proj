
$(document).ready(function() {
	$('div#dialog_box > form').submit(function(event) {
		event.preventDefault();
		dice(event);
	})
})
//execute queries and put results on the page
window.onload =  function() {
			$.get('dscripts/load_base_data.php', {called:true} , function(data) {
				original_table= $('table#base_data');
				results_table = $('table#operation_data');
				headers = "<tr><th class='tab_header'>Matricule</th><th>Student Name</th><th>Residence Quarter</th>"+
						"<th>Average Km dist from school</th><th>Student Religion</th><th>Student Church</th>"+
						"<th>Semester number</th><th>School Year</th>"+
						"<th>Mark</th><th>Course Code</th><th>Course Title</th><th>Course Lecturer</th></tr>";

				original_table.append(data);
				results_table.append(data);

				$("input[type *= text]").attr("readonly", "readonly");
				$("input[type *= text]").attr();
			})
}
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
	var form="";
	switch(operationID) {
		case "student&religion":
			form = "form#stud_reli_dice";
			break;
		case "student&course":
			form = "form#stud_crse_dice";
			break;
		case "student&residence":
			form = "form#stud_reside_dice";
			break;
		case "student&time":
			form = "form#stud_period_dice";
			break;
		case "course&religion":
			form = "form#course_reli_dice";
			break;
		case "course&residence":
			form = "form#course_reside_dice";
			break;
		case "course&time":
			form = "form#course_time_dice";
			break;
		case "religion&residence":
			form = "form#reli_reside_dice";
			break;
		case "religion&time":
			form = "form#reli_time_dice";
			break;
		default:
			alert(operationID);
			break;
	}
	$(form).css("display", "inline");
	$("div#dialog").css("display", "inline");
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
function remove (fields) {
	for (var count = fields.length - 1; count >= 0; count--) {
		$(fields[count]).css("display", "none");
	}
}
function dice(event) {
	var formID = event.target.id; //each form has an id and forms are the event targets not submit buttons
	var valid = $("form#"+formID+" input[type='text']:not([disabled])");
	var requestStatus = $("form#"+formID+" input[type='radio']").serialize();
	var form="formid="+formID+"&";
	var formData = requestStatus+"&"+form+valid.serialize();
	
	$("form#"+formID+" button[type='reset']").trigger("click");
	close_dialog();

	$.ajax( {
		type : 'GET',
		url : './dscripts/dice.php',
		data: formData,
		dataType : 'json',
		encode : true
	}).done (function (results) {
		set_results(results.headers+results.rows);
	});
}
function updateField(fieldID, formID) {
	var box = $("form#"+formID+" input[name="+fieldID);
	var inputField = $("form#"+formID+" input[name='"+fieldID.slice(4)+"']");

	if(box.prop("checked")) {
		inputField.attr("disabled", "disabled");
	} else {
		inputField.removeAttr("disabled");
	}
}
function close_dialog() {
	$("div#dialog").css("display", "none");
	$("div#dialog_box > form").css("display", "none");
}
function enforceEditable(value, formID) {

	var cbox = $("form#"+formID+" input[value ='"+value+"']");
	var inputFields = $("form#"+formID+" input[type='text']");

	switch(value) {
		case "exclude":
			if(cbox.prop("checked"))
				inputFields.attr("readonly", "readonly");
			else
				inputFields.removeAttr("readonly");
		break;
		case"include":
			inputFields.removeAttr("readonly");
			inputFields.attr("required", "required");
			break;
	}
	if(box.prop("checked")) {
		inputField.attr("disabled", "disabled");
	} else {
		inputField.removeAttr("disabled");
	}
}