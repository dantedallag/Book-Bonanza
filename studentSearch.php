<!DOCTYPE html>
<html lang="en">
<!--This is the search page for students-->

<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="TeacherEditAdd.css" rel="stylesheet">

<script>
function logOut() {
	window.location.href = "/~ddallaga/htdocs/";
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
<div class="container">
	<h2>Enter your Reading Interests</h2>
	<form>
		<div class="form-group1" style=bl>
			<label for "sel1">Author</label>
			<input type="text" onblur="authorFilter()" style="width: 200px" class="form-control" id="sel1"/>
		</div>
		<div class="form-group1" style=bl>
			<label for "sel2">Lexile Level(Required)</label>
			<input type="number" min="1" pattern="^[1-9]\d*$" style="width: 200px" class="form-control" id="sel2"/>
		</div>
		<div class="form-group1" style=bl>
			<label for "sel3">Length</label>
			<input type="number" min="1" pattern="^[1-9]\d*$" style="width: 200px" class="form-control" id="sel3"/>
		</div>
	</form>
	<form style="padding-left: 50px; width=3000px;">
		<div class="form-group21">
			<div class="col-xs-3 selectContainer">
				<label for "sel4">Genre</label>
				<select class="form-control" id="sel4">
                    <option selected='selected' value="Historical Fiction">Historical Fiction</option>
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
				<label for "sel5">Protagonist Trait 1</label>
				<select class="form-control" id="sel5">
                    <option selected='selected' value="Short">African American</option>
                    <option value="Native American">Native American</option>
                    <option value="Mexican American">Mexican American</option>
                    <option value="Scandinavian American">Scandinavian American</option>
                    <option value="Hispanic">Hispanic</option>
                    <option value="Chilean">Chilean</option>
                    <option value="Pakistani">Pakistani</option>
                    <option value="Haitian">Haitian</option>
                    <option value="Polish">Polish</option>
                    <option value="Persian">Persian</option>
                    <option value="Afghanistani">Afghanistani</option>
                    <option value="Interracial">Interracial</option>
                    <option value="Biracial">Biracial</option>
                    <option value="Young">Young</option>
                    <option value="Dog">Dog</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Dog">Couple</option>
					<option value="Dog">Animal</option>
				</select>			
			</div>
           	<div class="col-xs-3 selectContainer">
				<label for "sel6">Protagonist Trait 2</label>
				<select class="form-control" id="sel6">
                    <option selected='selected' value="">Choose Second Trait</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Couple">Couple</option>
				</select>				
			</div>
		</div>
	</form>
        <button type="button" class="btn btn-default" id="submit">Submit Selections</button>
		<script>
		//gather information for book search
		$("#submit").click( function() {
            var lex = document.getElementById("sel2").value;
			//A bit of entry sanitization, this is the only one that matters though
            if($.trim(lex).length == 0){
                alert("You must enter a Lexile Level.");
                return;
            }
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
			var url = "studentSearchServer.php";
			//POST here just adds the variables to SESSION
			$.post(url,data,function(res) {
				var newUrl = '/htdocs/searchResultsClient.php';
				window.location.href = newUrl;
			});
		});
		</script>
</div>
</body>
</html>
