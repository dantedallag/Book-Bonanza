<?php
	session_start();
	$author = $_SESSION['author'];
	$lexile = $_SESSION['lexile'];
	$length = $_SESSION['length'];
	$genre = $_SESSION['genre'];
	$trait1 = $_SESSION['trait1'];
	$trait2 = $_SESSION['trait2'];
	include "credentials.php";
	$connection = mysqli_connect($host, $user, $password, $database)
		or die("Error: " . mysqli_error($connection));
	if(!$connection) {
		echo "Error connecting";
		return;
	}
	$resultSet = mysqli_query($connection, 'SELECT * FROM books B');
	$avgRating = mysqli_query($connection, 'SELECT AVG(recommendations) avg FROM books');
	$thing = mysqli_fetch_assoc($avgRating);
	$avg = $thing['avg'];
	
	//Traverses rows of books
	if(mysqli_num_rows($resultSet) > 0){
		$resultArray = array();
		while($row = mysqli_fetch_array($resultSet)){
			//Score values to be compared
			$score = 0.0;
			//Lexile is most important
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
			
			if($row['recommendations'] >= $avg)
				$score += 0.68;
			
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
			//Change this value as needed to refine scores
			if($score < 1.0)
				continue;
			$row['score'] = $score;
			$resultArray[] = $row;
		}
	}
	if(count($resultArray) != 0){
		foreach($resultArray as $key => $row)
			$sort[$key] = $row['score'];
		array_multisort($sort, SORT_DESC, $resultArray); 
	
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
				<th style='display:none;'></th>
			  </tr>
			</thead>
			<tbody id='resTable'>";
		//Prints the top 10 recommended books into a table
		for($i = 0;$i < 10, $i < count($resultArray);$i++){
			echo "<tr>
					<td id = 'row".$i."'><input id='check" .$i."' type='checkbox'></td>";
			echo "<td>".$resultArray[$i]['title']."</td>";
			echo "<td>".$resultArray[$i]['author']."</td>";
			echo "<td>".$resultArray[$i]['lexile']."L</td>";
			echo "<td>".$resultArray[$i]['page_length']."</td>";
			echo "<td>".$resultArray[$i]['trait1']."</td>";
			echo "<td>".$resultArray[$i]['trait2']."</td>";
			echo "<td>".$resultArray[$i]['recommendations']."</td>";
			echo "<td style='display:none;' id='bID".$i."'>".$resultArray[$i]['id']."</td>";
			echo "</tr>";
		}

		echo "</tbody>
			</table>";
	}
	else{
		//Prints if no values returned
		echo "<p align='center'>Sorry, no results returned.</p>";
	}
	mysqli_close($connection);
?>