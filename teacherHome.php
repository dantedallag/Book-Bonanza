<!DOCTYPE html> 
<html lang="en">
 
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type = "text/javascript">
// function myFunction()
// {
// document.getElementById("t").innerHTML = id="t"><button type="submit" class="btn btn-default" onclick="myFunction()" align="center;">Yes</button>;
// }

function loadPage() {
	if(!localStorage.getItem("isTeacher")) {
		var url = "http://linux.students.engr.scu.edu/~ddallaga/htdocs"
		window.location.replace(url);
	} else {
		var teacherName = localStorage.getItem("name");
		document.getElementById("teacherHeader").innerHTML = "Welcome Teacher" + teacherName + "!"
		console.log(teacherName);
	}
}
window.onload = loadPage;
</script>
 
<link href="studentHome.css" rel="stylesheet">
</head>

<body>
<div class="info">
  <form class="student-welcome">
    <h2 id="teacherHeader">Welcome 'insert teacher name here'!</h2>
  </form>
</div>
<div class="booklist">
  <form class="teacher-welcome">
    <h2>Your Class' Book List</h2>
	</form>
<button type="button" id="addBook">Add Book</button>
<script>
$("#addBook").click(function() {
	window.location.replace("http://linux.students.engr.scu.edu/~ddallaga/htdocs/TeacherAdd.html")
});
</script>
	
<?php
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
$result = mysqli_query($connection, "SELECT title,author,lexile,page_length,genre,trait1,trait2,recommended FROM books"); 
//End of sql block

if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td id='title'>" . $row['title'] . "</td>";
			echo "<td>" . $row['author'] . "</td>";
			echo "<td>" . $row['lexile'] . "</td>";
			echo "<td>" . $row['page_length'] . "</td>";
			echo "<td>" . $row['genre'] . "</td>";
			echo "<td>" . $row['trait1'] . "</td>";
			echo "<td>" . $row['trait2'] . "</td>";
			echo "<td>" . $row['recommended'] . "</td>";
			echo "<td><button type='submit' class='btn btn-default' id='edit' align='center;'>Edit</button>
			<script>
			$('#edit').click(function() {
				//NOT SURE HOW TO PASS THIS
				var title = $row['title'].val();
				console.log(title);
				var url = 'teacherEdit.php';
				$.post(url,title,function(res) {
					var newUrl = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/teacherEdit.html';
					console.log(res);
					window.location.replace(newUrl);
				});
			});
			</script>
			<button type='submit' class='btn btn-default' id='delete' align='center;'>Delete</button></td>";
			echo "</tr>";
			$count++;
	}
}
mysqli_close($connection);
echo "</tbody> </table>";
?>
</body>	
</html>