<?php
    session_start();
    $ids = json_decode($_POST['idsString']);
    include "credentials.php";
    $connection = mysqli_connect($host, $user, $password, $database)
        or die("Error: " . mysqli_error($connection));
    if(!$connection) {
        echo "Error connecting";
    }
	//Adds the chosen books to the users account
	for($i = 0;$i < count($ids);$i++){
        $results = mysqli_query($connection, "SELECT id FROM users WHERE person_name='".$_SESSION['name']."'");
        $row = mysqli_fetch_array($results);
        $var1 = $row[0];
        $var2 = $ids[$i];
		$results = mysqli_query($connection, "INSERT INTO chosen(user_id,book_id) VALUES(" . $var1. "," . $var2 . ")");
    }
	mysqli_close($connection);
?>
