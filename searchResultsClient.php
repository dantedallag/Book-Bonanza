<!DOCTYPE html> 
<html lang="en">
 
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
<link href="studentHome.css" rel="stylesheet">
</head>

<body>
<div class="info">
</div>
<div class="booklist">
  <form class="student-welcome">
    <h2>Search Results</h2>
  </form>
</div>
<?php 
	session_start();
	if( !isset($_SESSION['credentials']) || $_SESSION['credentials'] == true) {
		header("Location: http://linux.students.engr.scu.edu/~ddallaga/htdocs/");
	}
	//Return this to normal after the demo
	//include 'searchResultsServer.php'
	include 'searchResultsServer.php';
?>
<form class="buttons">
    <input type="button" id="submit" class="btn btn-default" value="Submit Choices!"/>
	<script>
        $("#submit").click(function() {
			//Holds IDs of books to add to relational table
			var ids = [];
			var tCount = $('#resTable tr').length;
			console.log(tCount);
			for(var i = 0;i < tCount;i++){
				if($('#row' + i).checked)
					console.log("hello!\n");
					ids.push($('#bID'+i).val());
			}
			console.log("hello again!\n");
			if(ids.length == 0)
				window.location.href = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/studentHomeClient.php';
			var idsString = JSON.stringify(ids);
			var data = {'idsString' : idsString};
			console.log(data['idsString']);
			var url = "searchResultsServerSubmit.php";
			$.post(url, data, function(res) {
				var newurl = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/studentHomeClient.php';
				console.log(res);
				window.location.href = newurl;
			});
		});
	</script>
</form>
</body>

