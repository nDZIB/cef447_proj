<?php
require "querries.php";
require "dbconnection.php";


//echo "field: ".($_GET['roll_up_to']);
if ($_GET['roll_up_to']) {
	try {
		switch ($_GET['roll_up_to']) {
			case 'department':
				$roll_up_query=$roll_up_to_department;
				break;
			case 'faculty':
				$roll_up_query = $roll_up_to_faculty;
				break;
			case 'shyear':
				$roll_up_query = $roll_up_to_school_year;
				break;
			case 'religion':
				$roll_up_query = $roll_up_to_religion;
				break;
			default:
				//$roll_up_query=$get_base_data_query;
				break;
		}
	$connection = get_database_connection();
	$pstatement = $connection->prepare ($roll_up_query);
	$base_data = $connection->query($roll_up_query);

	$number_of_columns = get_resultset_size($connection, $roll_up_query);
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