<!DOCTYPE html> 
<html lang="en">
 
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function myFunction()
{
document.getElementById("t").innerHTML = id="t"><button type="submit" class="btn btn-default" onclick="myFunction()" align="center;">Yes</button>;
}
</script>
 
<link href="studentHome.css" rel="stylesheet">
</head>

<body>
<div class="info">
  <form class="student-welcome">
    <h2>Welcome 'insert teacher name here'!</h2>
  </form>
</div>
<div class="booklist">
  <form class="teacher-welcome">
    <h2>Your Class' Book List</h2>
  </form>
  <?php
	$server = 'localhost';
	$user = 'pj';
	$pw = 'chaos1996';
	$dbname = 'books';
	$connection = mysqli_connect($server,$user,$pw,$dbname);
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$resultSet = mysqli_query($connection, "SELECT title, author, lexile, page_length, genre, trait1, trait2, recommended FROM books");
	
	echo "<table class='table table-striped' align='center'>
	<thead>
	<tr>
	<th>Book Title</th>
	<th>Author</th>
    <th>Lexile Level</th>
    <th>Length</th>
	<th>Genre</th>
    <th>Protagonist Trait 1</th>
    <th>Protagonist Trait 2</th>
	<th>Recommendations</th>
    <th>Edit/Delete</th>
	</tr>
	</thead>
	<tbody>";
	
	while($row = mysqli_fetch_array($resultSet)){
		echo "<tr>";
		echo "<td>" . $row['title'] . "</td>";
		echo "<td>" . $row['author'] . "</td>";
		echo "<td>" . $row['lexile'] . "</td>";
		echo "<td>" . $row['page_length'] . "</td>";
		echo "<td>" . $row['genre'] . "</td>";
		echo "<td>" . $row['trait1'] . "</td>";
		echo "<td>" . $row['trait2'] . "</td>";
		echo "<td>" . $row['recommended'] . "</td>";
		echo "<td id='t'><button type='submit' class='btn btn-default' onclick='myFunction()' align='center;'>Edit</button>
		<button type='submit' class='btn btn-default' onclick='myFunction()' align='center'>Delete</button></td>";
		echo "</tr>";
	}
	
	mysqli_close($connection);
	
	
	echo "</tbody> </table>";
  ?>
