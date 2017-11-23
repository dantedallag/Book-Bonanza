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
			for(var i=0;i<tCount;i++){
				console.log("yay");
				if($('#check'+i).prop('checked')) {
					console.log("#bID" + i + "\n");
					ids.push($('#bID'+i).text());
				}
			}
			console.log("hello again!\n");
			if(ids.length == 0)
				window.location.href = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/studentHomeClient.php';
			console.log(ids);
			var idsString = JSON.stringify(ids);
			console.log(idsString);
			var data = {'idsString' : idsString};
			var url = "searchResultsServerSubmit.php";
			$.post(url, data, function(res) {
				var newUrl = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/studentHomeClient.php';
				console.log(res);
				//window.location.href = newUrl;
			});
		});
	</script>
</form>
</body>

