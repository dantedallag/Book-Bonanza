<?php
	session_start();
	$author = $_SESSION['author'];
	$lexile = $_SESSION['lexile'];
	$length = $_SESSION['length'];
	$genre = $_SESSION['genre'];
	$trait1 = $_SESSION['trait1'];
	$trait2 = $_SESSION['trait2'];
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
	$avgRating = mysqli_query($connection, 'SELECT AVG(recommended) avg FROM books');
	$thing = mysqli_fetch_assoc($avgRating);
	$avg = $thing['avg'];
	
	if(mysqli_num_rows($resultSet) > 0){
		$resultArray = array();
		while($row = mysqli_fetch_array($resultSet)){
			$score = 0.0;
			if($row['lexile'] <= $lexile)
				$score += 1.0;
			else if($row['lexile'] <= ($lexile + 150))
				$score += 0.8;
			else if($row['lexile'] <= ($lexile + 300))
				$score += 0.6;
			else if($row['lexile'] <= ($lexile + 450))
				$score += 0.4;
			else
				$score += 0.2;
			
			if($row['author'] === $author)
				$score += 0.84;
			
			if($row['recommended'] >= $avg)
				$score += 0.68;
			//Need to know how length is done
			if($length > 0){
				if($row['page_length'] <= ($length + 25) || $row['page_length'] >= ($length - 25))
					$score += 0.52;
			}
			if($row['genre'] === $genre)
				$score += 0.36;
			
			if($row['trait1'] === $trait1 || $row['trait1'] === $trait2)
				$score += 0.1;
			if($row['trait2'] === $trait1 || $row['trait2'] === $trait2)
				$score += 0.1;
			//Change this value as needed
			if($score < 1.0)
				continue;
			$row['score'] = $score;
			$resultArray[] = $row;
		}
	}
	//Should sort the array by sub associative arrays by the 'score' key
	/*usort($resultArray, function ($itemA, $itemB){
		return $itemA['score'] - $itemB['score'];
	});*/
	foreach($resultArray as $key => $row)
		$sort[$key] = $row['score'];
	array_multisort($sort, SORT_DESC, $resultArray); 
	
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
			<th>Recommendations</th>
			<th style='display:none;'></th>
		  </tr>
		</thead>
		<tbody id='resTable'>";
	//Should print the recommended books
	//style='display:none;'
	for($i = 0;$i < 10, $i < count($resultArray);$i++){
		echo "<tr>
				<td id = 'row".$i."'><input type='checkbox'></td>";
		echo "<td>".$resultArray[$i]['title']."</td>";
		echo "<td>".$resultArray[$i]['author']."</td>";
		echo "<td>".$resultArray[$i]['lexile']."L</td>";
		echo "<td>".$resultArray[$i]['page_length']."</td>";
		echo "<td>".$resultArray[$i]['trait1']."</td>";
		echo "<td>".$resultArray[$i]['trait2']."</td>";
		echo "<td>".$resultArray[$i]['recommended']."</td>";
		echo "<td style='display:none;' id='bID".$i."'>".$resultArray[$i]['id']."</td>";
		echo $resultArray[$i]['score']." ";
		echo "</tr>";
	}

	echo "</tbody>
		</table>";
		
	mysqli_close($connection);
?>