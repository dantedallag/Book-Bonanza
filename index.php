<?php
	session_start();
	//if you are a teacher, check code
	if (isset($_POST['credentials'])) {
		$var = $_POST['credentials'];
		$_SESSION['credentials'] = true;
		$_SESSION['name'] = $_POST['name'];
		$fh = fopen('teacherCode.txt','r');
		$line = fgets($fh);
		fclose($fh);
		$newVar = md5($var);
		if($line == $newVar) {
			$response = array('name' => 'theName');
			echo json_encode($response);
		}
	}
	//if you are a student, fetch student name or add student to database if they do not exist 
	else if (isset($_POST['name'])) {
		$_SESSION['credentials'] = false;
		$personName = $_POST['name'];
		$_SESSION['name'] = $personName;
		include "credentials.php";
		$connection = mysqli_connect($host, $user, $password, $database)
			or die("Error: " . mysqli_error($connection));
		if (!$connection) {
			echo "Error connecting";
		}
		$result = mysqli_query($connection, "SELECT id FROM users WHERE person_name = '" . $personName . "'");
		$row = mysqli_fetch_array($row);
		$_SESSION['student_id'] = $row['id'];
		$result = mysqli_query($connection, "INSERT INTO users(person_name,is_teacher) VALUES('".$personName."', false)"); 
		mysqli_close($connection);
	}
?>