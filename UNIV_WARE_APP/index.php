
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
			</ul>
		</div>
		<div class="col-7" id="dice-by" onmouseover="show_operation_fields(this.id)">
			<span>Dice-By</span>
			<ul class="operation_list" id="dice_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="Student_dim" onclick="dice(this.id)">Student</li>
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

<div id="dialog">
	<div id="dialog_box" class="row">
		<div class="col-6">
			<!-- <form> -->
				<fieldset>
					<legend>Dice Attributes</legend>
					<fieldset>
						<legend>Available Dimensions</legend>
						<label><input type="checkbox" onclick="get_dim_fields(this.value)" name="av_dimensions" value="student_dim"> Student </label><br>
						<label><input type="checkbox" onclick="get_dim_fields(this.value)" name="av_dimensions" value="religion_dim"> Religion </label><br>
						<label><input type="checkbox" onclick="get_dim_fields(this.value)" name="av_dimensions" value="course_dim"> Course </label><br>
						<label><input type="checkbox" onclick="get_dim_fields(this.value)" name="av_dimensions" value="residence_dim"> Residence </label><br>
						<label><input type="checkbox" onclick="get_dim_fields(this.value)" name="av_dimensions" value="time_dim" checked="checked"> Time </label><br>
					</fieldset>
					<!-- button to give option to select fields to display -->
					<button onclick="display_available_fields()">Continue</button>
				</fieldset>
			<!-- </form> -->
		</div>
		<div id="prev_selected_dims" class="col-6">
			<h1>Selected dimensions</h1>
		</div>
		<div class="col-12" id="selected_fields">
		</div>
	</div>
</div>

</body>