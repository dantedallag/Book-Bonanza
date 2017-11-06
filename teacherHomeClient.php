<!DOCTYPE html> 
<html lang="en">
 
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
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
</div>
<?php 
	include 'teacherHomeServer.php';
?>
</body>
</html>
	