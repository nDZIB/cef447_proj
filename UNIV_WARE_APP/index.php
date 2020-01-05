
<head>
<title>univ_warehouse</title>
</head>

<body>
	<script type="text/javascript" src="./scripts/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="./scripts/index_script.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/styles.css">

<button onclick="show_dialog()">CLICK ME or die</button>
	<div id="base_data_div">
		<center><h1 style="color: green;">Original Data Visualization</h1></center>
		<center>
			<table id = 'base_data'>
			</table>
		</center>
	</div>
<br>
<br>
<hr>
<div>
	<center><h1 style="color:green;">Operations</h1></center>
	<div id="operations" class="row" onmouseleave="tidy_up()">
		<div class="col-7" id="roll-up-to" onmouseover="show_operation_fields(this.id)">
			Roll Up
			<ul class="operation_list" id="roll_up_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="roll_up(this.id)">Department</li>
				<li class="operation" id="faculty" onclick="roll_up(this.id)">Faculty</li>
				<li class="operation" id="religion" onclick="roll_up(this.id)">Religion</li>
				<li class="operation" id="Shool_year" onclick="roll_up(this.id)">Shool_year</li>
			</ul>
		</div>
		<div class="col-7" id="drill-down-to" onmouseover="show_operation_fields(this.id)">
			<span>Drill-Down-to</span>
			<ul class="operation_list" id="drill_down_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="drill_down(this.id)">Department</li>
				<li class="operation" id="faculty" onclick="roll_up(this.id)">Faculty</li>
				<li class="operation" id="religion" onclick="roll_up(this.id)">Religion</li>
				<li class="operation" id="Shool_year" onclick="roll_up(this.id)">Shool_year</li>
			</ul>
		</div>

		<div class="col-7" id="slice-by" onmouseover="show_operation_fields(this.id)">
			<span>Slice-By</span>
			<ul class="operation_list" id="slice_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="Student_dim" onclick="slice(this.id)">Student</li>
				<li class="operation" id="course_dim" onclick="slice(this.id)">Course</li>
				<li class="operation" id="time_dim" onclick="slice(this.id)">Time</li>
				<li class="operation" id="religion_dim" onclick="slice(this.id)">Religions</li>
				<li class="operation" id="residence_dim" onclick="slice(this.id)">Residences</li>
			</ul>
		</div>
		<div class="col-7" id="dice-by" onmouseover="show_operation_fields(this.id)">
			<span>Dice-By</span>
			<ul class="operation_list" id="dice_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="Student_dim" onclick="initiate_dice(this.id)">Student</li>
				<li class="operation" id="student&religion" onclick="initiate_dice(this.id)">Student And Religion</li>
			</ul>
		</div>
		<div class="col-7" id="pivot-around" onmouseover="show_operation_fields(this.id)">
			<span>Pivot-Around</span>
			<ul class="operation_list" id="pivot-around" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="pivot(this.id)">Department</li>
			</ul>
		</div>
		<!-- it was here -->
	</div>
	<div>
		<h2 style="color: blue;">Results</h2>
		<center>
			<table id="operation_data">	
			</table>
		</center>
	</div>
</div>
<form>
<input type='text' name="age" value="578"><br>
</form>
<div id="dialog">
	<div id="dialog_box" class="row">
		<form id='stud_reli_dice' method='GET' action="dscripts/dice.php">
			<label><input type="radio" name="includevalues" value="include" checked="checked">Include values</label>
			<label><input type="radio" name="includevalues" value="exclude">Exclude values</label>
				<div class='row'>
					<div class='col-6'>
						<fieldset><legend>Student Info Specs</legend>
							<label>Full name <input type='text' name="name" disabled="disabled"></label><br>
							<input type="checkbox"  name="sendname" onclick="updateField(this.name)" checked="checked">Include name<br>
							<label>Matricule #<input type='text' name="matricule"></label><br>
							<input type="checkbox"  name="sendmatricule" onclick="updateField(this.name)">Include matricule<br>
							<label>Faculty <input type="text" name="fac"></label><br>
							<input type="checkbox" name="sendfac" onclick="updateField(this.name)">Include Faculty<br>
							<label>Department <input type="text" name="depart"></label><br>
							<input type="checkbox" name="senddepart" onclick="updateField(this.name)">Include Department<br>
							<label># of Lectures <input type="text" name="tsc"></label><br>
							<input type="checkbox" name="sendtsc" onclick="updateField(this.name)">Include Lecturer #<br>
						</fieldset>
					</div><div class='col-6'>
						<fieldset><legend>Religion Info Specs</legend>
							<label>Religion Name <input type='text' name="religionname"></label><br>
							<input type="checkbox" name="sendreligionname" onclick="updateField(this.name)">Exclude religion<br>
							<label>Church Name <input type="text" name="churchname"></label><br>
							<input type="checkbox" name="sendchurchname" onclick="updateField(this.name)">Exclude church name<br>
						</fieldset>
					</div>
				</div>
				<!-- <input type='submit' value='Execute' name='query'><br> -->
				<button name="stud_reli_dice">OH</button>
		</form>
		<!-- 2 was here -->
	</div>

</div>

</body>