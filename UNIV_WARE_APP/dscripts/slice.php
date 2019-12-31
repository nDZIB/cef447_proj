<?php

require "querries.php";
require "dbconnection.php";

if ($_GET['dim_to_slice']) {
	try {
	$dimension = $_GET['dim_to_slice'];
	$connection = get_database_connection();
	$slice_query .= $dimension.";";
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