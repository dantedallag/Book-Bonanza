<?php
	$ids = $_POST['ids'];
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
	for($i = 0;$i < $ids.count();$i++){
		//Need userID here
		$results = mysqli_query("INSERT INTO chosen VALUES(". .",".$ids[i].", FALSE)");
	}
	mysqli_close($connection);
?>
