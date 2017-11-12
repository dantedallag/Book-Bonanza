<?php
	$author = $_POST['author'];
	$lexile = $_POST['lexile'];
	$length = $_POST['length'];
	$genre = $_POST['genre'];
	$trait1 = $_POST['trait1'];
	$trait2 = $_post['trait2'];
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

	$resultSet = mysqli_query($connection, 'SELECT title, author, lexile, page_length, genre, trait1, trait2, recommended FROM books');
	$avgRating = mysqli_query($connection, 'SELECT AVG(recommended) avg FROM books');
	$thing = mysqli_fetch_assoc($avgRating);
	$avg = $thing['avg'];
	
	if(mysqli_num_rows($resultSet) > 0){
		$resultArray = array();
		while($row = mysqli_fetch_array($resultSet){
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
			
			if(row['trait1'] === $trait1 || row['trait1'] === $trait2)
				$score += 0.1;
			if(row['trait2'] === $trait1 || row['trait2'] === $trait2)
				$score += 0.1;
			//Change this value as needed
			if($score < 1.0)
				continue;
			$row['score'] = $score;
			$resultArray[] = $row;
		}
	}
	//Should sort the array by sub associative arrays by the 'score' key
	usort($resultArray, function ($itemA, $itemB){
		return $itemB['score'] <=> $itemA['score'];
	});
	
	echo "<table class='table table-striped' align='center'>
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
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td id='t'><input type='checkbox'</td>
			<td>Sample Book</td>
			<td>Sample Name</td>
			<td>Easy</td>
			<td>100</td>
			<td>Good</td>
			<td>Bad</td>
			<td>3</td>
		  </tr>";
	//Should print the recommended books
	for($i = 0;$i < 10, $i < $resultArray.count();$i++){
		echo "<r>
				<td id = 'row".$i."'><input type='checkbox'></td>";
		echo "<td>".$resultArray[$i]['title']."</td>";
		echo "<td>".$resultArray[$i]['author']."</td>";
		echo "<td>".$resultArray[$i]['lexile']."L</td>";
		echo "<td>".$resultArray[$i]['page_length']."</td>";
		echo "<td>".$resultArray[$i]['trait1']."</td>";
		echo "<td>".$resultArray[$i]['trait2']."</td>";
		echo "<td>".$resultArray[$i]['recommendations']."</td>";
	}

	echo "</tbody>
		</table>";
		
	mysqli_close($connection);
?>