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

	$result = mysqli_query($connection, "SELECT person_name FROM users WHERE is_teacher = false");

echo "<script>";
echo "
function getStudentBooks() {
	var name = $('#studentBox :selected').text();
	$('#tableBody').empty();
	loadXMLDocStudent(name);
	console.log(name);
}";
echo "</script>";

	echo "<select id='studentBox' onChange='getStudentBooks()'>";
	echo "<option value='All Books'>All Books</option>";
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			echo "<option value='" . $row['person_name'] . "'>" . $row['person_name'] . "</option>";
		}
	}
	echo "</select>";

echo "<table class='table table-striped' align='center' id='bookTable'>
<thead>
<tr>
<th>Book Title</th>
<th>Author</th>
<th>Lexile Level</th>
<th>Length</th>
<th>Genre</th>
<th>Protagonist Trait 1</th>
<th>Protagonist Trait 2</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody id = 'tableBody'>";

$result = mysqli_query($connection, "SELECT title,author,lexile,page_length,genre,trait1,trait2,recommended FROM books"); 

$count = 0;
if(mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td id='title" . $count . "'>" . $row['title'] . "</td>";
			echo "<td id='author" . $count . "'>" . $row['author'] . "</td>";
			echo "<td>" . $row['lexile'] . "</td>";
			echo "<td>" . $row['page_length'] . "</td>";
			echo "<td>" . $row['genre'] . "</td>";
			echo "<td>" . $row['trait1'] . "</td>";
			echo "<td>" . $row['trait2'] . "</td>";
			//echo "<td>" . $row['recommended'] . "</td>";
			echo "<td><button type='submit' class='btn btn-default' id='edit" . $count . "' align='center;'>Edit</button>";
			echo "<script>
			$(document).on('click','#edit" . $count . "', function()  {
					var title = $('#title" . $count . "').text();
					var author = $('#author" .$count . "').text();
					localStorage.setItem('title', title);
					localStorage.setItem('author', author);
					var newUrl = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/TeacherEdit.html';
					window.location.href = newUrl;
				});
			</script>";
			echo "<td><button type='submit' class='btn btn-default' id='delete" . $count . "' align='center;'>Delete</button></td>";
			echo "<script>
			$(document).on('click', '#delete" . $count . "', function() {
				var title = $('#title" . $count . "').text();
				var author = $('#author" . $count . "').text();
				console.log(author);
				console.log(title);
				loadXMLDocDelete(title,author);
			});
			</script>";
			echo "</tr>";
			$count = $count + 1;
		}
	}
	echo "</tbody> </table>";
	mysqli_close($connection);
?>