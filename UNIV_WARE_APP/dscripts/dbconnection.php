<?php



function get_database_connection()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "university_warehouse";
	$base_data;
	$connection = NULL;
	try {
		$connection = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch (PDOException $e) {
	echo "Error durring connection: ".$e->getMessage();
} 
	return $connection;
}

//get headers
function get_resultset_headers($resultset, $size) {
	$table_header = "<tr>";
	for ($i=0; $i < $size ; $i++) { 
		$table_header .= "<th>".$resultset->getColumnMeta($i)['name']."</th>";
	}
	$table_header .= "</tr>";

	return $table_header;
}

//get number of columns in resultset
function get_resultset_size($connection, $query) {
	$pstatement2 = $connection->prepare ($query);
	$pstatement2->execute();
	return $pstatement2->columnCount();
}

//get a table row from a row
function fetch_table_row($row, $number_of_columns) {
	$table_row = "<tr>";
		for ($i=0; $i < $number_of_columns; $i++) { 
			$table_row .= "<td>".$row[$i]."</td>";
		}
	return $table_row."</tr>";
}
?>