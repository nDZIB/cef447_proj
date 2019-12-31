(
	function () {
	}) ()



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
		window.onload =  function() {
			$.get('dscripts/load_base_data.php', {called:true} , function(data) {
				original_table= $('table#base_data');
				results_table = $('table#operation_data');
				headers = "<tr><th>Matricule</th><th>Student Name</th><th>Residence Quarter</th>"+
						"<th>Average Km dist from school</th><th>Student Religion</th><th>Student Church</th>"+
						"<th>Semester number</th><th>School Year</th>"+
						"<th>Mark</th><th>Course Code</th><th>Course Title</th><th>Course Lecturer</th></tr>";

				original_table.append(data);
				results_table.append(data);

				// //create buttons
				// operations = $('div#operations');
				// buttons = "<button id='roll-up' onclick='roll_up(this.id)'>Roll-Up</button>&nbsp;"+
				// 		"<button id='drill-down' onclick='drill_down(this.id)'>Drill-Down</button>&nbsp;"+
				// 		"<button id='slice' onclick='slice(this.id)'>Slice</button>&nbsp;"+
				// 		"<button id='dice' onclick='dice(this.id)'>Dice</button>&nbsp;"+
				// 		"<button id='pivot' onclick='pivot(this.id)'>Pivot</button>&nbsp;";
				// operations.append(buttons);
				//$("ul#ops").css("display", "inline");


			})
		}

//function to handle roll-up operations on a relevant field
function roll_up(field) {
	$.get("./dscripts/roll_up.php", {roll_up_to:field}, function(data) {
		set_results(data);
	})
}

function slice(operationID) {
	$.get("./dscripts/slice.php", {dim_to_slice:operationID}, function(results) {
		set_results(results);
	})
}

function dice(operationID) {
	$.get("./dscripts/dice.php", {dim_one:"student_dim", dim_two:"time_dim"}, function(results) {
		set_results(results);
	})
}

function drill_down(operationID) {
	$.get("./dscripts/roll_up.php", {roll_up_to:operationID}, function(results) {
		set_results(results);
	})
}

function set_results(data) {
	tidy_up();
	results_table = $('table#operation_data').html(data);
}


function show_operation_fields(id) {
	//hide all operation lists
	tidy_up();
	$("li#"+id+" ul").css("display", "inline");
}

function hide_list(list_id) {
	$("ul#"+list_id).css("display", "none");
}

function tidy_up() {
	$("ul.operation_list").css("display", "none");
}





