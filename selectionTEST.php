<?php
	session_start();
	$ids = array();
	$host = "dbserver.engr.scu.edu";
	$user = "ddallaga";
	$password = "00001033223";
	$database = "sdb_ddallaga";
	$port = 3306;
	$connection = mysqli_connect($host, $user, $password, $database)
		or die("Error: " . mysqli_error($connection));
	if(!$connection) {
		echo "Error connecting";
		return;
	}

	$resultSet = mysqli_query($connection, 'SELECT * FROM books');

	if(mysqli_num_rows($resultSet) > 0) {
		$resultArray = array();
		for($i = 0;$i < 10; $i++){
			$row = mysqli_fetch_array($resultSet);
			$resultArray[] = $row;
		}
	}
	echo "<table class='table table-striped' align='center;'>
		<thead>
		  <tr>
			<th>Select</th>
			<th>Book</th>
			<th>Author</th>
			<th>Difficulty</th>
			<th>Length</th>
			<th>Protagonist Trait 1</th>
			<th>Protagonist Trait 2</th>
			<th style='display:none;'></th>
		  </tr>
		</thead>
		<tbody id='resTable'>";
	//Should print the recommended books
	for($i = 0;$i < 10, $i < count($resultArray);$i++){
		$ids[$i] = $resultArray[$i];
		echo "<tr>
				<td id = 'row".$i."'><input type='checkbox'></td>";
		echo "<td>".$resultArray[$i]['title']."</td>";
		echo "<td>".$resultArray[$i]['author']."</td>";
		echo "<td>".$resultArray[$i]['lexile']."L</td>";
		echo "<td>".$resultArray[$i]['page_length']."</td>";
		echo "<td>".$resultArray[$i]['trait1']."</td>";
		echo "<td>".$resultArray[$i]['trait2']."</td>";
		//echo "<td>".$resultArray[$i]['recommendations']."</td>";
		//ASK ABOUT DOING BLANK ROW TO STORE IDs
		echo "<td style='display:none;' id='bID".$i."'>".$resultArray[$i]['id']."</td>";
		echo "</tr>";
	}
	$_SESSION['ids'] = $ids;

	echo "</tbody>
		</table>";
		
	mysqli_close($connection);

?>
