<!DOCTYPE html> 
<html lang="en">
 
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Student choice updates --> 

<script>
//table filter/re-render for individual student
function loadXMLDocStudent(studentName) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
			document.getElementById("tableBody").innerHTML = this.responseText;
    }
	};
	var data = new FormData();
	data.append('studentName', studentName);
  var url = "/htdocs/teacherHomeServerTableUpdate.php";
  xhttp.open("POST", url, true);
  xhttp.send(data);
}

//delete element/re-render table
function loadXMLDocDelete(title,author) {
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
			document.getElementById("tableBody").innerHTML = this.responseText;
    }
	};
	var data = new FormData();
	data.append('title', title);
	data.append('author', author)
  var url = "/htdocs/teacherHomeServerTableUpdate.php";
  xhttp.open("POST", url, true);
  xhttp.send(data);
}
</script>

<script>
//initial code running
function loadPage() {
	if(!localStorage.getItem("isTeacher")) {
		var url = "/htdocs/";
		window.location.href = url;
	} else {
		var teacherName = localStorage.getItem("name");
		document.getElementById("teacherHeader").innerHTML = "Welcome Teacher " + teacherName + "!";
	}
}
window.onload = loadPage;
</script>

<?php 
  session_start();
  if( !isset($_SESSION['credentials']) || $_SESSION['credentials'] == false) {
      header("Location: /htdocs/");
  }
?>

<link href="/htdocs/studentHome.css" rel="stylesheet">

<script>
function logOut() {
	window.location.href = "/htdocs/";
}
</script>

<style>
.logout{

   position:fixed;
   right:10px;
   top:5px;
}

.center {
    margin: auto;
    width: 60%;
    border: 3px solid #73AD21;
    padding: 10px;
}
</style>


</head>

<body>
<button class="logout" onclick="logOut()">logout</button>
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
	window.location.href = "/htdocs/teacherAddClient.php";

});
</script>
</div>
<?php 
include '/htdocs/teacherHomeServer.php';
?>
</body>
</html>
	