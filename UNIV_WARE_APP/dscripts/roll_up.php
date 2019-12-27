<?php
require "querries.php";
require "dbconnection.php";

if (1!=2) {
	try {
		$department = "'Computer Engineering'";//$_GET['department'];
	$connection = get_database_connection();
	$pstatement = $connection->prepare ($roll_up_to_department);
	//$pstatement->bindParam(1, $department, PDO::PARAM_STR);

	$base_data = $connection->query($roll_up_to_department);

	//get table column names
	$pstatement2 = $connection->prepare ($roll_up_to_department);
	$pstatement2->execute();
	$number_of_columns = $pstatement2->columnCount();
	
	$table_header = get_resultset_headers($base_data, $number_of_columns);

	//get rows
	$table_rows="";
	while($row = $base_data->fetch(PDO::FETCH_NUM)) {
		$table_rows = $table_rows."<tr>";
		$table_rows = $table_rows."<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td>"."<td>".$row[3]."</td><td>".$row[4]."</td>"
									."<td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td>"
									."<td>".$row[9]."</td><td>".$row[10]."</td>";
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