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
	//Return this to normal after the demo
	//include 'searchResultsServer.php'
	include 'selectionTEST.php';
?>
<form class="buttons">
    <input type="button" class="btn btn-default" value="Submit Choices!" onclick="window.location.href='studentHome.html'"/>
	<script>
        $("#submit").click(function() {
			//Holds IDs of books to add to relational table
			var ids = [];
			var tCount = $('#resTable tr').length;
			for(var i=0;i<tCount;i++){
				if($('#row'+i).checked)
					ids.push($('#bID'+i).val());
			}
			if(ids.length == 0)
				window.location.href = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/studentHome.php';
			var data = {}
			data['ids'] = ids;
			var url = "searchResultsServerSubmit.php";
			$.post(url, data, function(res) {
				var newurl = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/studentHome.php';
				console.log(res);
				window.location.href = newurl;
			});
		});
	</script>
</form>
</body>

