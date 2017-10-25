<?php
	if (isset($_POST['credentials'])) {
		$var = $_POST['credentials'];
		$fh = fopen('teacherCode.txt','r');
		$line = fgets($fh);
		fclose($fh);
		if($line == $var) {
			echo "True";
		} else {
			echo "False";
		}
	} else {
		echo "Did Not Run";
	}
?>