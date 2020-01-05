<?php

require "querries.php";
require "dbconnection.php";


	
	$query;
	if($_GET['includevalues']=="include") {
		$query = generateValuedSQLQUERY($_GET);
	} else {
		$query = generateColumnBasedSQLQUERY($_GET);
	}
	echo json_encode(array('rows'=>$query));
	//echo json_encode($_GET);
	// try {
	
	// $connection = get_database_connection();

	// $pstatement = $connection->prepare ($dice_query);

	// $base_data = $connection->query($dice_query);

	// //get table column 
	// $number_of_columns = get_resultset_size($connection, $dice_query);
	// $table_header = get_resultset_headers($base_data, $number_of_columns);

	// //get rows
	// $table_rows="";
	// while($row = $base_data->fetch(PDO::FETCH_NUM)) {
	// 	$table_rows .= fetch_table_row($row, $number_of_columns);
	// }
	// echo json_encode(array('rows'=>$table_rows, 'headers'=>$table_header));
	// } catch (PDOException $e) {
	// echo json_encode(array('rows'=>$e->getMessage()));
	// }

	function generateValuedSQLQUERY($data) {
		$tables="";
	$columns="";
	switch ($data['formid']) {
		case 'stud_reli_dice':
			$tables=' student_dim, religion_dim WHERE ';
			break;
		default:
			$tables=' student_dim, religion_dim WHERE ';
			break;
	}
	$submited = "";
	foreach ($data as $name => $value) {
		switch ($name) {
			case 'name':
				$name = "stud_full_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'matricule':
				$name='stud_matricule';
				$submited .= $name." = '".$value."' AND ";
				$columns .= $name." , ";
				break;
			case 'fac':
				$name = "stud_faculty_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'depart':
				$name = "stud_department_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'stud_tsc':
				$name = "stud_department_tsc";
				$submited .= $name." >= ".$value." AND ";
				$columns .= $name." , ";
				break;
			case 'religionname':
				$name="religion";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'churchname':
				$name="church_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			default:
				break;
		}
	}
	$submited = "SELECT ".substr($columns, 0, -2)." FROM ".$tables.$submited;

	return substr($submited, 0, -4);
	}


function generateColumnBasedSQLQUERY($data) {
	$tables="";
	$columns="";
	switch ($data['formid']) {
		case 'stud_reli_dice':
			$tables=' student_dim, religion_dim ';
			break;
		default:
			$tables=' student_dim, religion_dim ';
			break;
	}
	$submited = "";
	foreach ($data as $name => $value) {
		switch ($name) {
			case 'name':
				$name = "stud_full_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'matricule':
				$name="stud_matricule";
				$submited .= $name." = '".$value."' AND ";
				$columns .= $name." , ";
				break;
			case 'fac':
				$name = "stud_faculty_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'depart':
				$name = "stud_department_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'tsc':
				$name = "stud_department_tsc";
				$submited .= $name." >= ".$value." AND ";
				$columns .= $name." , ";
				break;
			case 'religionname':
				$name = "religion";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'churchname':
				$name="church_name";
				break;


			//just added
			case '':
				$name="course_code";
				$submited .= $name." = '".$value."' AND ";
				$columns .= $name." , ";
				break;
			case '':
				$name="course_title";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case '':
				$name="course_lecturer_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case '':
				$name="course_lecturer_highest_qualification";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case '':
				$name="quarter";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case '':
				$name="akmd_to_school";
				$submited .= $name." >= ".$value." AND ";
				$columns .= $name." , ";
				break;
			default:
				break;
		}
	}
	$submited = "SELECT ".substr($columns, 0, -2)." FROM ".$tables;

	return $submited;
}

?>