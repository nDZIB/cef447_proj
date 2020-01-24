<?php
require 'dbconnection.php';
require 'querries.php';

//creating connection

if(1!=2) {
try {
	$connection = get_database_connection();
	$pstatement = $connection->prepare ($get_base_data_query);
	$base_data = $connection->query($get_base_data_query);

	//get table column names
	$pstatement2 = $connection->prepare ($get_base_data_query);
	$pstatement2->execute();

	$number_of_columns = $pstatement2->columnCount();
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