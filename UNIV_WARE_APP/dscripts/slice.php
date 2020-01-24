<?php

require "querries.php";
require "dbconnection.php";

if ($_GET['dim_to_slice']) {
	try {
	$dimension = $_GET['dim_to_slice'];
	$connection = get_database_connection();

	$fields="";
	$id = "";
	switch ($dimension) {
		case 'student_dim':
			$fields = " stud_matricule, stud_full_name, stud_faculty_name, stud_department_name, stud_department_tsc ";
			$id = " student_dim.stud_sn = score_facts.stud_sn ";
			break;
		case 'course_dim':
			$fields = " course_code, course_title, course_lecturer_name, course_lecturer_email, course_lecturer_highest_qualification ";
			$id = " course_dim.course_sn = score_facts.course_sn ";
			break;
		case 'religion_dim':
			$fields = " church_name, religion ";
			$id = " religion_dim.religion_sn = score_facts.religion_sn ";
			break;
		case 'residence_dim':
			$fields = " quarter, akmd_to_school ";
			$id = " residence_dim.residence_sn = score_facts.residence_sn ";
			break;
		case 'time_dim':
			$fields = " semester_number, school_year ";
			$id = " time_dim.time_sn = score_facts.time_sn ";
			break;
		default:
			break;
	}

	$slice_query =  "SELECT ".$fields." FROM ".$dimension." JOIN score_facts ON ".$id;

	$pstatement = $connection->prepare ($slice_query);
	$base_data = $connection->query($slice_query);

	//get table column names
	$number_of_columns = get_resultset_size($connection, $slice_query);
	$table_header = get_resultset_headers($base_data, $number_of_columns);

	//get rows
	$table_rows="";
	while($row = $base_data->fetch(PDO::FETCH_NUM)) {
		$table_rows .= fetch_table_row($row, $number_of_columns);
	}
	echo $table_header.$table_rows;
	} catch (PDOException $e) {
	echo "Error executing query: ".$e->getMessage();
}
} else {
	echo "<center><h1 style='color:red;'>Unauthorised Acces!</h1></center>";
}


?>