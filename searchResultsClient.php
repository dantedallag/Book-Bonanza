<!DOCTYPE html> 
<html lang="en">

<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
<link href="studentHome.css" rel="stylesheet">
<script>
function logOut() {
	window.location.href = "index.html";
}
</script>

<style>
.logout{

   position:fixed;
   right:10px;
   top:5px;
}
</style>


</head>

<body>
<button class="logout" onclick="logOut()">logout</button>
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

			for(var i=0;i<tCount;i++){
				if($('#check'+i).prop('checked')) {
					ids.push($('#bID'+i).text());
				}
			}
			if(ids.length == 0)
				window.location.href = 'studentHomeClient.php';
			var idsString = JSON.stringify(ids);
			var data = {'idsString' : idsString};
			var url = "searchResultsServerSubmit.php";
			$.post(url, data, function(res) {
				var newUrl = 'studentHomeClient.php';
				window.location.href = newUrl;
			});
		});
	</script>
</form>
</body>

