<?php

	require "dbconnection.php";
	require "querries.php";
	$dimension = $_GET['dim'];
	//get all the fields for this current dimension


	if($_GET['dim']) {
		$dimension = $_GET['dim'];

		$dbconnection = get_database_connection();
		$query = $slice_query.$dimension.";";
		$resultset_size = get_resultset_size($dbconnection, $query);

		$pstatement = $dbconnection->prepare($query);
		$results = $dbconnection->query($query);

		//construct a list of headers to return
		$header_list = get_resultset_headers_list($results, $resultset_size);
		echo $header_list;
	} else {
		echo "<h1> Unauthorised access </h2>";
	}
?>