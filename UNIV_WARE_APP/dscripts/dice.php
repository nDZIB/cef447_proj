<?php

require "querries.php";
require "dbconnection.php";

if ($_GET['dim_one'] && $_GET['dim_two']) {
	try {
	$dimension_1 = $_GET['dim_one'];
	$dimension_2 = $_GET['dim_two'];
	
	$connection = get_database_connection();

	$dice_query .= $dimension_1." , ".$dimension_2.";";
	$pstatement = $connection->prepare ($dice_query);

	$base_data = $connection->query($dice_query);

	//get table column names
	$pstatement2 = $connection->prepare ($dice_query);
	$pstatement2->execute();
	$number_of_columns = $pstatement2->columnCount();
	
	$table_header = get_resultset_headers($base_data, $number_of_columns);

	//get rows
	$table_rows="";
	while($row = $base_data->fetch(PDO::FETCH_NUM)) {
		$table_rows = $table_rows."<tr>";
		for ($i=0; $i < $number_of_columns; $i++) { 
			$table_rows .= "<td>".$row[$i]."</td>";
		}
		$table_rows = $table_rows."</tr>";
	}
	echo $table_header.$table_rows;
	} catch (PDOException $e) {
	echo "Error executing query: ".$e->getMessage();
}
} else {
	echo "<center><h1 style='color:red;'>Unauthorised Acces!</h1></center>";
}

?>