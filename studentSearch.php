<?php
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
//Query for lexile, author(optional), and recommendations?
$result = mysqli_query($connection,"SELECT title, author, lexile, page_length, genre, trait1, trait2, recommended FROM books");
$avgRating = mysqli_query($connection,"SELECT AVG(recommended) FROM books");
//Pass result set onto searchResults and parse the remainder?
mysqli_close($connection);
?>