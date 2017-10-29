<?php
	if (isset($_POST['credentials'])) {
		$var = $_POST['credentials'];
		$fh = fopen('teacherCode.txt','r');
		$line = fgets($fh);
		fclose($fh);
		if($line == $var) {
			$response = array('name' => 'theName');
			echo json_encode($response);
		} 
	} else if(isset($_POST['name'])) {
		$personName = $_POST['name'];
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
		$result = mysqli_query($connection, "INSERT INTO users(person_name,is_teacher) VALUES('".$personName."', false)"); 
		echo "user in database now";

		mysqli_close($connection);

		//querry books that student has for his page

		//add a book with teacher criteria

		//get all of the books for teacher
	}
?>