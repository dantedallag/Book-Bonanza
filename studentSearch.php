<!DOCTYPE html>
<html lang="en">
<!--This is the search page for students-->
<!--TODO: Need to change pre-populated values/draw from MySQL, change Lexile and Length to text entry, filter results if blank-->

<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="TeacherEditAdd.css" rel="stylesheet">

<!--
<script>
	<!--Script to populate the Combo Boxes
	function populateCBoxes(){
		for(i=1;i<7;i++){
			$('#sel' + i).append('<option>'+ 'Hello'+ '</option>');
		}
	}
</script>
-->

</head>

<body>
<div class="container">
	<h2>Enter your Reading Interests</h2>
	<form>
		<div class="form-group1" style=bl>
			<label for "sel1">Author</label>
			<input type="text" style="width: 200px" class="form-control" id="sel1"/>
		</div>
		<div class="form-group1" style=bl>
			<label for "sel2">Lexile Level(Required)</label>
			<input type="number" style="width: 200px" class="form-control" id="sel2"/>
		</div>
		<div class="form-group1" style=bl>
			<label for "sel3">Length</label>
			<input type="number" style="width: 200px" class="form-control" id="sel3"/>
		</div>
	</form>
	<form style="padding-left: 50px; width=3000px;">
		<div class="form-group21">
			<div class="col-xs-3 selectContainer">
				<label for "sel4">Genre</label>
				<select class="form-control" id="sel4">
					<option value="">Choose Genre</option>
					<option value="Historical Fiction">Historical Fiction</option>
					<option value="Children's Literature">Children's Literature</option>
					<option value="Fantasy">Fantasy</option>
					<option value="Novel">Novel</option>
					<option value="Young Adult">Young Adult</option>
					<option value="Realistic Fiction">Realistic Fiction</option>
					<option value="Fiction">Fiction</option>
					<option value="Adventure">Adventure</option>
					<option value="Romance">Romance</option>
					<option value="Middle Grade">Middle Grade</option>
					<option value="Science Fiction">Science Fiction</option>
					<option value="Mystery">Mystery</option>
					<option value="Horror">Horror</option>
					<option value="Biography">Biography</option>
					<option value="Picture Book">Picture Book</option>
				</select>
			</div>
		</div>
		<div class="form-group22">
           	<div class="col-xs-3 selectContainer">
				<label for "sel5">1st Protagonist Trait</label>
				<select class="form-control" id="sel5">
					<option value="">Choose First Trait</option>
                    <option value="">African American</option>
                    <option value="">Native American</option>
                    <option value="">Mexican American</option>
                    <option value="">Scandinavian American</option>
                    <option value="">Hispanic</option>
                    <option value="">Chilean</option>
                    <option value="">Pakistani</option>
                    <option value="">Haitian</option>
                    <option value="">Polish</option>
                    <option value="">Persian</option>
                    <option value="">Afghanistani</option>
                    <option value="Long">Interracial</option>
                    <option value="Short">Biracial</option>
                    <option value="Long">Young</option>
                    <option value="Medium">Dog</option>
					<option>Male</option>
					<option>Female</option>
					<option>Couple</option>
					<option>Animal</option>
				</select>			
			</div>
           	<div class="col-xs-3 selectContainer">
				<label for "sel6">2nd Protagonist Trait</label>
				<select class="form-control" id="sel6">
					    <option value="">Choose Second Trait</option>
		                <option value="Male">Male</option>
		                <option value="Female">Female</option>
	                    <option value="Couple">Couple</option>
				</select>				
			</div>
		</div>
	</form>
		<!--Change href link when the search page is ready -->
        <button type="button" class="btn btn-default" id="submit">Submit Selections</button>
		<script>
		$("#submit").click( function() {
			var author = $("#sel1").val();
			var lexile = $("#sel2").val();
			if(lexile == ""){
				alert("Please enter your Lexile Level.");
				return;
			}
			var length = $("#sel3").val();
			var genre = $("#sel4 :selected").text();
			var trait1 = $("#sel5 :selected").text();
			var trait2 = $("#sel6 :selected").text();
			var data = {"author": author, "lexile": lexile, "length": length, "genre": genre, "trait1": trait1, "trait2": trait2};
			console.log(data);
			var url = "studentSearchServer.php";
			$.post(url,data,function(res) {
				var newUrl = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/searchResultsClient.php';
				console.log(res);
				window.location.href = newUrl;
			});
		});
		</script>
</div>
</body>
</html>
