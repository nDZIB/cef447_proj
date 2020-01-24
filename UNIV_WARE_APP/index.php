
<head>
<title>univ_warehouse</title>
</head>

<body>
	<script type="text/javascript" src="./scripts/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="./scripts/index_script.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/styles.css">
	
	<div id="base_data_div">
		<center><h1 style="color: green;">Original Data Visualization</h1></center>
		<center>
			<table id = 'base_data'>
			</table>
		</center>
	</div>
<br>
<hr>
<div id="work-area">
	<center><h1 style="color:green; padding: 0px; margin: 0px;">Operations</h1></center>
	<div id="operations" class="row" onmouseleave="tidy_up()">
		<div class="col-7 operation-menu" id="roll-up-to" onmouseover="show_operation_fields(this.id)">
			Roll Up
			<ul class="operation_list" id="roll_up_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="roll_up(this.id)">Department</li>
				<li class="operation" id="faculty" onclick="roll_up(this.id)">Faculty</li>
				<li class="operation" id="religion" onclick="roll_up(this.id)">Religion</li>
				<li class="operation" id="shyear" onclick="roll_up(this.id)">Shool_year</li>
			</ul>
		</div>
		<div class="col-7 operation-menu" id="drill-down-to" onmouseover="show_operation_fields(this.id)">
			<span>Drill-Down-to</span>
			<ul class="operation_list" id="drill_down_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="drill_down(this.id)">Department</li>
				<li class="operation" id="faculty" onclick="roll_up(this.id)">Faculty</li>
				<li class="operation" id="religion" onclick="roll_up(this.id)">Religion</li>
				<li class="operation" id="shyear" onclick="roll_up(this.id)">Shool_year</li>
			</ul>
		</div>

		<div class="col-7 operation-menu" id="slice-by" onmouseover="show_operation_fields(this.id)">
			<span>Slice-By</span>
			<ul class="operation_list" id="slice_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="student_dim" onclick="slice(this.id)">Student</li>
				<li class="operation" id="course_dim" onclick="slice(this.id)">Course</li>
				<li class="operation" id="time_dim" onclick="slice(this.id)">Time</li>
				<li class="operation" id="religion_dim" onclick="slice(this.id)">Religions</li>
				<li class="operation" id="residence_dim" onclick="slice(this.id)">Residences</li>
			</ul>
		</div>
		<div class="col-7 operation-menu" id="dice-by" onmouseover="show_operation_fields(this.id)">
			<span>Dice-By</span>
			<ul class="operation_list" id="dice_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="student&religion" onclick="initiate_dice(this.id)">Student And Religion</li>
				<li class="operation" id="student&course" onclick="initiate_dice(this.id)">Student and Courses</li>
				<li class="operation" id="student&residence" onclick="initiate_dice(this.id)">Student and Residences</li>
				<li class="operation" id="student&time" onclick="initiate_dice(this.id)">Student and School period</li>
				<li class="operation"><hr></li>
				<li class="operation" id="course&religion" onclick="initiate_dice(this.id)">Course and Religions</li>
				<li class="operation" id="course&residence" onclick="initiate_dice(this.id)">Course and Residences</li>
				<li class="operation" id="course&time" onclick="initiate_dice(this.id)">Course and School periods</li>
				<li class="operation" ><hr></li>
				<li class="operation" id="religion&residence" onclick="initiate_dice(this.id)">Religion and Residences</li>
				<li class="operation" id="religion&time" onclick="initiate_dice(this.id)">Religion and School periods</li>
			</ul>
		</div>
		<div class="col-7 operation-menu" id="pivot-around" onmouseover="show_operation_fields(this.id)">
			<span>Pivot-Around</span>
			<ul class="operation_list" id="pivot-around" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="pivot(this.id)">Department</li>
			</ul>
		</div>
	</div>
	<div id="data-work-area">
		<br>
		<!-- <h2 style="color: blue;">Results</h2> -->
		<center>
			<table id="operation_data">	
			</table>
		</center>
	</div>
</div>
<div id="dialog">
	<div id="dialog_box" class="row">
		<div class="dialog_box_header" onclick="close_dialog()">X</div>
		<form id='stud_reli_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" onclick="enforceEditable(this.value, 'stud_reli_dice')" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include" onclick="enforceEditable(this.value, 'stud_reli_dice')">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Student Info Specs</legend>
							<label>Full name <input type='text' name="name" disabled="disabled"></label><br>
							<input type="checkbox"  name="sendname" onclick="updateField(this.name, 'stud_reli_dice')" checked="checked">Include name<br>
							<label>Matricule #<input type='text' name="matricule"></label><br>
							<input type="checkbox"  name="sendmatricule" onclick="updateField(this.name, 'stud_reli_dice')">Include matricule<br>
							<label>Faculty <input type="text" name="fac"></label><br>
							<input type="checkbox" name="sendfac" onclick="updateField(this.name, 'stud_reli_dice')">Include Faculty<br>
							<label>Department <input type="text" name="depart"></label><br>
							<input type="checkbox" name="senddepart" onclick="updateField(this.name, 'stud_reli_dice')">Include Department<br>
							<label># of Lectures <input type="text" name="tsc"></label><br>
							<input type="checkbox" name="sendtsc" onclick="updateField(this.name, 'stud_reli_dice')">Include Lecturer #<br>
						</fieldset>
					</div><div class='col-6'>
						<fieldset><legend>Religion Info Specs</legend>
							<label>Religion Name <input type='text' name="religionname"></label><br>
							<input type="checkbox" name="sendreligionname" onclick="updateField(this.name, 'stud_reli_dice')">Exclude religion<br>
							<label>Church Name <input type="text" name="churchname"></label><br>
							<input type="checkbox" name="sendchurchname" onclick="updateField(this.name, 'stud_reli_dice')">Exclude church name<br>
						</fieldset>
					</div>
				</div>
				<button name="stud_reli_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
		<form id='stud_crse_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Student Info Specs</legend>
							<label>Full name <input type='text' name="name" disabled="disabled"></label><br>
							<input type="checkbox"  name="sendname" onclick="updateField(this.name, 'stud_crse_dice')" checked="checked">Include name<br>
							<label>Matricule #<input type='text' name="matricule"></label><br>
							<input type="checkbox"  name="sendmatricule" onclick="updateField(this.name, 'stud_crse_dice')">Include matricule<br>
							<label>Faculty <input type="text" name="fac"></label><br>
							<input type="checkbox" name="sendfac" onclick="updateField(this.name, 'stud_crse_dice')">Include Faculty<br>
							<label>Department <input type="text" name="depart"></label><br>
							<input type="checkbox" name="senddepart" onclick="updateField(this.name, 'stud_crse_dice')">Include Department<br>
							<label># of Lectures <input type="text" name="tsc"></label><br>
							<input type="checkbox" name="sendtsc" onclick="updateField(this.name, 'stud_crse_dice')">Include Lecturer #<br>
						</fieldset>
					</div><div class='col-6'>
						<fieldset><legend>Course Info Specs</legend>
							<label>Course Code <input type='text' name="code"></label><br>
							<input type="checkbox" name="sendcode" onclick="updateField(this.name, 'stud_crse_dice')">Exclude Course Code<br>
							<label>Course Title <input type="text" name="title"></label><br>
							<input type="checkbox" name="sendtitle" onclick="updateField(this.name, 'stud_crse_dice')">Exclude Course Title<br>
							<label>Lecturer name<input type="text" name="lectname"></label><br>
							<input type="checkbox" name="sendlectname" onclick="updateField(this.name, 'stud_crse_dice')">Exclude Lecturer Name<br>
							<label>Lecturer name<input type="text" name="lectemail"></label><br>
							<input type="checkbox" name="sendlectemail" onclick="updateField(this.name, 'stud_crse_dice')">Exclude Lecturer email<br>
							<label>Lecturer name<input type="text" name="lectqualification"></label><br>
							<input type="checkbox" name="sendlectqualification" onclick="updateField(this.name, 'stud_crse_dice')">Exclude Lecturer Highest qualification<br>
						</fieldset>
					</div>
				</div>
				<button name="stud_crse_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
		<form id='stud_reside_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Student Info Specs</legend>
							<label>Full name <input type='text' name="name" disabled="disabled"></label><br>
							<input type="checkbox"  name="sendname" onclick="updateField(this.name, 'stud_reside_dice')" checked="checked">Include name<br>
							<label>Matricule #<input type='text' name="matricule"></label><br>
							<input type="checkbox"  name="sendmatricule" onclick="updateField(this.name, 'stud_reside_dice')">Include matricule<br>
							<label>Faculty <input type="text" name="fac"></label><br>
							<input type="checkbox" name="sendfac" onclick="updateField(this.name, 'stud_reside_dice')">Include Faculty<br>
							<label>Department <input type="text" name="depart"></label><br>
							<input type="checkbox" name="senddepart" onclick="updateField(this.name, 'stud_reside_dice')">Include Department<br>
							<label># of Lectures <input type="text" name="tsc"></label><br>
							<input type="checkbox" name="sendtsc" onclick="updateField(this.name, 'stud_reside_dice')">Include Lecturer #<br>
						</fieldset>
					</div>
					<div class='col-6'>
						<fieldset><legend>Residence Info Specs</legend>
							<label>Quarter <input type='text' name="quarter"></label><br>
							<input type="checkbox" name="sendquarter" onclick="updateField(this.name, 'stud_reside_dice')">Exclude Quarter<br>
							<label>Average Distance <input type="text" name="akmd"></label><br>
							<input type="checkbox" name="sendakmd" onclick="updateField(this.name, 'stud_reside_dice')">Exclude Distance<br>
						</fieldset>
					</div>
				</div>
				<button name="stud_reside_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
		<form id='stud_period_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Student Info Specs</legend>
							<label>Full name <input type='text' name="name" disabled="disabled"></label><br>
							<input type="checkbox"  name="sendname" onclick="updateField(this.name, 'stud_period_dice')" checked="checked">Include name<br>
							<label>Matricule #<input type='text' name="matricule"></label><br>
							<input type="checkbox"  name="sendmatricule" onclick="updateField(this.name, 'stud_period_dice')">Include matricule<br>
							<label>Faculty <input type="text" name="fac"></label><br>
							<input type="checkbox" name="sendfac" onclick="updateField(this.name, 'stud_period_dice')">Include Faculty<br>
							<label>Department <input type="text" name="depart"></label><br>
							<input type="checkbox" name="senddepart" onclick="updateField(this.name, 'stud_period_dice')">Include Department<br>
							<label># of Lectures <input type="text" name="tsc"></label><br>
							<input type="checkbox" name="sendtsc" onclick="updateField(this.name, 'stud_period_dice')">Include Lecturer #<br>
						</fieldset>
					</div>
					<div class='col-6'>
						<fieldset><legend>Period Info Specs</legend>
							<label>Semester Number <input type='text' name="semesternumber"></label><br>
							<input type="checkbox" name="sendsemesternumber" onclick="updateField(this.name, 'stud_period_dice')">Exclude Semester<br>
							<label>Academic Year <input type="text" name="acyear"></label><br>
							<input type="checkbox" name="sendacyear" onclick="updateField(this.name, 'stud_period_dice')">Exclude Academic year<br>
						</fieldset>
					</div>
				</div>
				<button name="stud_period_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
		<form id='course_reli_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Course Info Specs</legend>
							<label>Course Code <input type='text' name="code"></label><br>
							<input type="checkbox" name="sendcode" onclick="updateField(this.name, 'course_reli_dice')">Exclude Course Code<br>
							<label>Course Title <input type="text" name="title"></label><br>
							<input type="checkbox" name="sendtitle" onclick="updateField(this.name, 'course_reli_dice')">Exclude Course Title<br>
							<label>Lecturer name<input type="text" name="lectname"></label><br>
							<input type="checkbox" name="sendlectname" onclick="updateField(this.name, 'course_reli_dice')">Exclude Lecturer Name<br>
							<label>Lecturer name<input type="text" name="lectemail"></label><br>
							<input type="checkbox" name="sendlectemail" onclick="updateField(this.name, 'course_reli_dice')">Exclude Lecturer email<br>
							<label>Lecturer name<input type="text" name="lectqualification"></label><br>
							<input type="checkbox" name="sendlectqualification" onclick="updateField(this.name, 'course_reli_dice')">Exclude Lecturer Highest qualification<br>
						</fieldset>
					</div>
					<div class='col-6'>
						<fieldset><legend>Religion Info Specs</legend>
							<label>Religion Name <input type='text' name="religionname"></label><br>
							<input type="checkbox" name="sendreligionname" onclick="updateField(this.name, 'course_reli_dice')">Exclude religion<br>
							<label>Church Name <input type="text" name="churchname"></label><br>
							<input type="checkbox" name="sendchurchname" onclick="updateField(this.name, 'course_reli_dice')">Exclude church name<br>
						</fieldset>
					</div>
				</div>
				<button name="course_reli_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
		<form id='course_time_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Course Info Specs</legend>
							<label>Course Code <input type='text' name="code"></label><br>
							<input type="checkbox" name="sendcode" onclick="updateField(this.name, 'course_time_dice')">Exclude Course Code<br>
							<label>Course Title <input type="text" name="title"></label><br>
							<input type="checkbox" name="sendtitle" onclick="updateField(this.name, 'course_time_dice')">Exclude Course Title<br>
							<label>Lecturer name<input type="text" name="lectname"></label><br>
							<input type="checkbox" name="sendlectname" onclick="updateField(this.name, 'course_time_dice')">Exclude Lecturer Name<br>
							<label>Lecturer name<input type="text" name="lectemail"></label><br>
							<input type="checkbox" name="sendlectemail" onclick="updateField(this.name, 'course_time_dice')">Exclude Lecturer email<br>
							<label>Lecturer name<input type="text" name="lectqualification"></label><br>
							<input type="checkbox" name="sendlectqualification" onclick="updateField(this.name, 'course_time_dice')">Exclude Lecturer Highest qualification<br>
						</fieldset>
					</div>
					<div class='col-6'>
						<fieldset><legend>Period Info Specs</legend>
							<label>Semester Number <input type='text' name="semesternumber"></label><br>
							<input type="checkbox" name="sendsemesternumber" onclick="updateField(this.name, 'course_time_dice')">Exclude Semester<br>
							<label>Academic Year <input type="text" name="acyear"></label><br>
							<input type="checkbox" name="sendacyear" onclick="updateField(this.name, 'course_time_dice')">Exclude Academic year<br>
						</fieldset>
					</div>
				</div>
				<button name="course_time_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
		<form id='course_reside_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Course Info Specs</legend>
							<label>Course Code <input type='text' name="code"></label><br>
							<input type="checkbox" name="sendcode" onclick="updateField(this.name, 'course_reside_dice')">Exclude Course Code<br>
							<label>Course Title <input type="text" name="title"></label><br>
							<input type="checkbox" name="sendtitle" onclick="updateField(this.name, 'course_reside_dice')">Exclude Course Title<br>
							<label>Lecturer name<input type="text" name="lectname"></label><br>
							<input type="checkbox" name="sendlectname" onclick="updateField(this.name, 'course_reside_dice')">Exclude Lecturer Name<br>
							<label>Lecturer name<input type="text" name="lectemail"></label><br>
							<input type="checkbox" name="sendlectemail" onclick="updateField(this.name, 'course_reside_dice')">Exclude Lecturer email<br>
							<label>Lecturer name<input type="text" name="lectqualification"></label><br>
							<input type="checkbox" name="sendlectqualification" onclick="updateField(this.name, 'course_reside_dice')">Exclude Lecturer Highest qualification<br>
						</fieldset>
					</div>
					<div class='col-6'>
						<fieldset><legend>Residence Info Specs</legend>
							<label>Quarter <input type='text' name="quarter"></label><br>
							<input type="checkbox" name="sendquarter" onclick="updateField(this.name, 'course_reside_dice')">Exclude Quarter<br>
							<label>Average Distance <input type="text" name="akmd"></label><br>
							<input type="checkbox" name="sendakmd" onclick="updateField(this.name, 'course_reside_dice')">Exclude Distance<br>
						</fieldset>
					</div>
				</div>
				<button name="course_reside_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
		<form id='reli_reside_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Religion Info Specs</legend>
							<label>Religion Name <input type='text' name="religionname" disabled="disabled"></label><br>
							<input type="checkbox" name="sendreligionname" checked="checked" onclick="updateField(this.name, 'reli_reside_dice')">Exclude religion<br>
							<label>Church Name <input type="text" name="churchname"></label><br>
							<input type="checkbox" name="sendchurchname" onclick="updateField(this.name, 'reli_reside_dice')">Exclude church name<br>
						</fieldset>
					</div>
					<div class='col-6'>
						<fieldset><legend>Residence Info Specs</legend>
							<label>Quarter <input type='text' name="quarter"></label><br>
							<input type="checkbox" name="sendquarter" onclick="updateField(this.name, 'reli_reside_dice')">Exclude Quarter<br>
							<label>Average Distance <input type="text" name="akmd"></label><br>
							<input type="checkbox" name="sendakmd" onclick="updateField(this.name, 'reli_reside_dice')">Exclude Distance<br>
						</fieldset>
					</div>
				</div>
				<button name="reli_reside_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
		<form id='reli_time_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="exclude" checked="checked">Consider fields</label><br>
			<!-- consider values, when checked, should change all input fields to require -->
			<label><input type="radio" name="includevalues" value="include">Consider values</label><br> 
			<label><input type="radio" name="includevalues" value="allfields">Show All Fields following criteria</label><br>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Religion Info Specs</legend>
							<label>Religion Name <input type='text' name="religionname"></label><br>
							<input type="checkbox" name="sendreligionname" onclick="updateField(this.name, 'reli_time_dice')">Exclude religion<br>
							<label>Church Name <input type="text" name="churchname"></label><br>
							<input type="checkbox" name="sendchurchname" onclick="updateField(this.name, 'reli_time_dice')">Exclude church name<br>
						</fieldset>
					</div>
					<div class='col-6'>
						<fieldset><legend>Period Info Specs</legend>
							<label>Semester Number <input type='text' name="semesternumber" disabled="disabled"></label><br>
							<input type="checkbox" name="sendsemesternumber" checked="checked" onclick="updateField(this.name, 'reli_time_dice')">Exclude Semester<br>
							<label>Academic Year <input type="text" name="acyear"></label><br>
							<input type="checkbox" name="sendacyear" onclick="updateField(this.name, 'reli_time_dice')">Exclude Academic year<br>
						</fieldset>
					</div>
				</div>
				<button name="reli_time_dice">Submit</button>
				<button type="reset" hidden="hidden">reset</button>
		</form>
	</div>

</div>

</body>