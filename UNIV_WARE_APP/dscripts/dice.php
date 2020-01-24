<?php

require "querries.php";
require "dbconnection.php";


	
	$query="";
	if($_GET['includevalues']=="include") {
		$query = generateValuedSQLQUERY($_GET);

	} elseif ($_GET['includevalues']=="exclude") {
		$query = generateColumnBasedSQLQUERY($_GET);
	} else {
		//$query  = genereateColumnAndValueBasedQUERY($_GET);
		$query = getAllColumns($_GET);
	}

	//echo json_encode(array("rows"=>$query));

	//query the database
	try {
		$connection = get_database_connection();
		$pstatement = $connection->prepare ($query);
		$base_data = $connection->query($query);

		//get table column 
		$number_of_columns = get_resultset_size($connection, $query);
		$table_header = get_resultset_headers($base_data, $number_of_columns);

		//get rows
		$table_rows="";
		while($row = $base_data->fetch(PDO::FETCH_NUM)) {
			$table_rows .= fetch_table_row($row, $number_of_columns);
		}
		echo json_encode(array('rows'=>$table_rows, 'headers'=>$table_header));
		} catch (PDOException $e) {
		echo json_encode(array('rows'=>$query));
		}

function generateValuedSQLQUERY($data) {
		$tables="";
		$columns="";
		switch ($data['formid']) {
		case 'stud_reli_dice':
			$tables=' score_facts
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn WHERE ';
			break;
		case 'stud_crse_dice':
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn WHERE ';
			break;
		case 'stud_reside_dice':
			$tables = ' score_facts 
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn WHERE ';
			break;
		case 'stud_period_dice':
			$tables = ' score_facts  
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn WHERE ';
			break;
		case 'course_reli_dice':
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn WHERE ';
			break;
		case 'course_time_dice':
			$tables = ' score_facts
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn WHERE ';
			break;
		case 'course_reside_dice':
			$tables = ' score_facts
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn WHERE ';
			break;
		case 'reli_reside_dice':
			$tables = ' score_facts
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn WHERE ';
			break;
		case 'reli_time_dice':
			$tables = ' score_facts
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn 
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn WHERE ';
			break;
		default:
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn WHERE ';
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

				// from religion dimension
			case 'religionname':
				$name = "religion";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'churchname':
				$name="church_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			//just added
				//from course dimension
			case 'code':
				$name="course_code";
				$submited .= $name." = '".$value."' AND ";
				$columns .= $name." , ";
				break;
			case 'title':
				$name="course_title";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'lectname':
				$name="course_lecturer_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'lectqualification':
				$name="course_lecturer_highest_qualification";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
				//from residence dimension
			case 'quarter':
				$name="quarter";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'akmd':
				$name="akmd_to_school";
				$submited .= $name." >= ".$value." AND ";
				$columns .= $name." , ";
				break;
				//from residence dimension
			case 'semesternumber':
				$name="semester_number";
				$submited .= $name." = ".$value." AND ";
				$columns .= $name." , ";
				break;
			case 'acyear':
				$name="school_year";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			default:
				break;
		}
		}
		$submited = "SELECT DISTINCT ".substr($columns, 0, -2)." FROM ".$tables.$submited;

		return substr($submited, 0, -4);
		}

function generateColumnBasedSQLQUERY($data) {
	$tables="";
	$columns="";
	switch ($data['formid']) {
		case 'stud_reli_dice':
			$tables=' student_dim, religion_dim ';
			break;
		case 'stud_crse_dice':
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn ';
			break;
		case 'stud_reside_dice':
			$tables = ' score_facts 
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn ';
			break;
		case 'stud_period_dice':
			$tables = ' score_facts  
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn ';
			break;
		case 'course_reli_dice':
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn ';
			break;
		case 'course_time_dice':
			$tables = ' score_facts
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn ';
			break;
		case 'course_reside_dice':
			$tables = ' score_facts
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn ';
			break;
		case 'reli_reside_dice':
			$tables = ' score_facts
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn ';
			break;
		case 'reli_time_dice':
			$tables = ' score_facts
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn ';
			break;
		default:
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn ';
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

				// from religion dimension
			case 'religionname':
				$name = "religion";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'churchname':
				$name="church_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			//just added
				//from course dimension
			case 'code':
				$name="course_code";
				$submited .= $name." = '".$value."' AND ";
				$columns .= $name." , ";
				break;
			case 'title':
				$name="course_title";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'lectname':
				$name="course_lecturer_name";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'lectqualification':
				$name="course_lecturer_highest_qualification";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
				//from residence dimension
			case 'quarter':
				$name="quarter";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			case 'akmd':
				$name="akmd_to_school";
				$submited .= $name." >= ".$value." AND ";
				$columns .= $name." , ";
				break;
				//from residence dimension
			case 'semesternumber':
				$name="semester_number";
				$submited .= $name." = ".$value." AND ";
				$columns .= $name." , ";
				break;
			case 'acyear':
				$name="school_year";
				$submited .= $name." LIKE '%".$value."%' AND ";
				$columns .= $name." , ";
				break;
			default:
				break;
		}
	}
	$submited = "SELECT DISTINCT ".substr($columns, 0, -2)." FROM ".$tables;

	return $submited;
}

function getAllColumns($data) {
	$tables="";
	$columns=" * ";
	switch ($data['formid']) {
		case 'stud_reli_dice':
			$tables=' student_dim, religion_dim ';
			break;
		case 'stud_crse_dice':
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn ';
			break;
		case 'stud_reside_dice':
			$tables = ' score_facts 
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn ';
			break;
		case 'stud_period_dice':
			$tables = ' score_facts  
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn ';
			break;
		case 'course_reli_dice':
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn ';
			break;
		case 'course_time_dice':
			$tables = ' score_facts
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn ';
			break;
		case 'course_reside_dice':
			$tables = ' score_facts
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn ';
			break;
		case 'reli_reside_dice':
			$tables = ' score_facts
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							 JOIN residence_dim ON residence_dim.residence_sn = score_facts.residence_sn ';
			break;
		case 'reli_time_dice':
			$tables = ' score_facts
							 JOIN religion_dim ON religion_dim.religion_sn = score_facts.religion_sn
							 JOIN time_dim ON time_dim.time_sn = score_facts.time_sn ';
			break;
		default:
			$tables = ' score_facts 
							 JOIN course_dim ON course_dim.course_sn = score_facts.course_sn
							 JOIN student_dim ON student_dim.stud_sn = score_facts.stud_sn ';
			break;
	}
	
	$submited = "SELECT DISTINCT ".$columns." FROM ".$tables;

	return $submited;

}

?>