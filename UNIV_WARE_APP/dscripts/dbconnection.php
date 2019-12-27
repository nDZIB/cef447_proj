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

?>