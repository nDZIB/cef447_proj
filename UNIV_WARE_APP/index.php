
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
<br>
<hr>
<div>
	<center><h1 style="color:green;">Operations</h1></center>
	<div id="operations" onmouseleave="tidy_up()">
		<ul id="ops">
		<li id="roll-up-to" onmouseover="show_operation_fields(this.id)" >
			Roll-Up-to
			<ul class="operation_list" id="roll_up_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="roll_up(this.id)">Department</li>
				<li class="operation" id="faculty" onclick="roll_up(this.id)">Faculty</li>
				<li class="operation" id="religion" onclick="roll_up(this.id)">Religion</li>
				<li class="operation" id="Shool_year" onclick="roll_up(this.id)">Shool_year</li>
			</ul>
		</li>
		<!-- next operation -->
		<li id="drill-down-to" onmouseover="show_operation_fields(this.id)" >
			Drill-Down-to
			<ul class="operation_list" id="drill_down_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="drill_down(this.id)">Department</li>
			</ul>
		</li>
		<!-- slice operation -->
		<li id="slice-by" onmouseover="show_operation_fields(this.id)" >
			Slice-By
			<ul class="operation_list" id="slice_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="Student_dim" onclick="slice(this.id)">Student</li>
			</ul>
		</li>
		<!-- Dice operation -->
		<li id="dice-by" onmouseover="show_operation_fields(this.id)" >
			Dice-By
			<ul class="operation_list" id="dice_list" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="Student_dim" onclick="dice(this.id)">Student</li>
			</ul>
		</li>
		<!-- pivot operation -->
		<li id="pivot-around" onmouseover="show_operation_fields(this.id)" >
			Pivot-Around
			<ul class="operation_list" id="pivot-around" onmouseleave ="hide_list(this.id)">
				<li class="operation" id="department" onclick="pivot(this.id)">Department</li>
			</ul>
		</li>
	</ul>
	</div>
	<div>
		<h2 style="color: blue;">Results</h2>
		<center>
			<table id="operation_data">	
			</table>
		</center>
	</div>

	
</div>

</body>