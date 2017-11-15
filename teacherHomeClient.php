<!DOCTYPE html> 
<html lang="en">
 
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Student choice updates --> 
<!--<script src="TeacherHome.js"></script> -->

<script>
function loadXMLDoc(studentName) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
			document.getElementById("tableBody").innerHTML = this.responseText;
    }
	};
	var data = new FormData();
	data.append('studentName', studentName);
  //var data = JSON.stringify({ "studentName" : studentName});
  var url = "teacherHomeServerTableUpdate.php";
  xhttp.open("POST", url, true);
  xhttp.send(data);
}

function loadXMLDocDelete(title,author) {
	var xhttp = new XMLHttpRequest();
	console.log("deleting");
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
			document.getElementById("tableBody").innerHTML = this.responseText;
    }
	};
	var data = new FormData();
	data.append('title', title);
	data.append('author', author)
  var url = "teacherHomeServerTableUpdate.php";
  xhttp.open("POST", url, true);
  xhttp.send(data);
}

</script>

<script>
function loadPage() {
	if(!localStorage.getItem("isTeacher")) {
		var url = "http://linux.students.engr.scu.edu/~ddallaga/htdocs";
		window.location.href = url;
	} else {
		var teacherName = localStorage.getItem("name");
		document.getElementById("teacherHeader").innerHTML = "Welcome Teacher " + teacherName + "!";
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
    <h1 id="teacherHeader">Welcome 'insert teacher name here'!</h1>
  </form>
  <form>
  		<div style="text-align:center">
  			<h2>Your Class' Book List</h2>
  		</div>
  		<div class="add-book">
    		<button type="button" id="addBook">Add Book</button>
    	</div>
  </form>

<script>
$("#addBook").click(function() {
	window.location.href = "http://linux.students.engr.scu.edu/~ddallaga/htdocs/TeacherAdd.html";

});
</script>
</div>
<?php 
include 'teacherHomeServer.php';
?>
</body>
</html>
	