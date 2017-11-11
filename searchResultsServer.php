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
	$avgRating = mysqli_query($connection, 'SELECT AVG(recommended) FROM books');
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


	echo "</tbody>
		</table>";
?>