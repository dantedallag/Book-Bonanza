<!DOCTYPE html> 
<html lang="en">
 
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
<link href="studentHome.css" rel="stylesheet">

<script>
function loadXMLDoc(studentName) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("table").innerHTML = this.responseText;
    }
  };
  var data = new FormData();
  data.append('studentName', studentName);
  //var data = JSON.stringify({ "studentName" : studentName});
  var url = "studentHomeServer.php";
  xhttp.open("POST", url, true);
  xhttp.send(data);
}
</script>

<script type="text/javascript">
  function loadName() {
    var studentName = localStorage.getItem("name");
    document.getElementById("studentHeader").innerHTML = "Welcome " + studentName + "!";
    loadXMLDoc(studentName);
  }
  window.onload = loadName;
</script>

</head>



<body>
<div class="info">
  <form class="student-welcome">
    <h2 id = "studentHeader">Welcome 'insert student name here'!</h2>
  </form>
</div>
<form class="buttons">
  <!--CHANGE THIS BACK TO 'studentSearch.html'-->
  <input type="button" class="btn btn-default" value="Find a New Book" onclick="window.location.href='studentSearch.php'" />
</form>
<div id="table" />
</body>
</html>
<!-- <script type="text/javascript">
  loadName();
</script> -->
