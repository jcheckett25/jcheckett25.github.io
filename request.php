<?php
function handle_mysqli_connection(){
	$hostname = "localhost";
	$db_username = "apidev";
	$db_password = "Turner2020!!";
	$db_name = "id15492695_api_data";

	$mysqli = mysqli_connect(
		$hostname,
		$db_username,
		$db_password,
		$db_name,
	);

	// Check connection
	if (mysqli_connect_errno() ) {
		echo "Failed to connect to MySQL:" . mysqli_connect_error();
		exit();
	}

	return $mysqli;
}

function get_the_data( $key){
	$return = "";
	if ( isset( $_POST[$key])){
		$return = $_POST[$key];
	} else if ( isset($_GET[$key])) {
		$return = $_GET[$key];
	}

	return $return;
}

function insert_the_data( $connection ) {
	$post_title = get_the_data("post_title");
	$post_information = get_the_data("post_information");
	$creation_date = date("Y-m-d H:i:s");

	$sql = "INSERT INTO api_information ( post_title, post_information, creation_date ) VALUES( '$post_title', '$post_information', $creation_date' )";

	if ( $connection->query( $sql ) !== TRUE ) {
		echo "Failed to insert data to MySQL table.";
		exit();
	}

	return TRUE;
}

$request_type = get_the_data( "request_type");
if (!empty( $request_type )) {
	$connection = handle_mysqli_connection(); 

	if ( $request_type == "insert") {
		insert_the_data( $connection );
	}
}
?>
