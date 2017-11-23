<?php
    session_start();
    $ids = $_SESSION['ids'];
    //$ids2 = json_decode($_POST['idsString']);
    ///print_r($ids2);
    //print_r($ids);
	$host = "dbserver.engr.scu.edu";
	$user = "ddallaga";
	$password = "00001033223";
	$database = "sdb_ddallaga";
    $port = 3306;
    $connection = mysqli_connect($host, $user, $password, $database)
        or die("Error: " . mysqli_error($connection));
    if(!$connection) {
        echo "Error connecting";
    }
	for($i = 0;$i < count($ids);$i++){
        //Need userID here
        $results = mysqli_query($connection, "SELECT id FROM users WHERE person_name='".$_SESSION['name']."'");
        $row = mysqli_fetch_array($results);
        $var1 = $row[0];
        $var2 = $ids[$i][0];
		$results = mysqli_query($connection, "INSERT INTO chosen(user_id,book_id) VALUES(" . $var1. "," . $var2 . ")");
    }
	mysqli_close($connection);
?>
