<!DOCTYPE html>
<html lang="eng">
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="TeacherEditAdd.css" rel="stylesheet">

<?php 
    session_start();
    if( !isset($_SESSION['credentials']) || $_SESSION['credentials'] == false) {
        header("Location: /~ddallaga/htdocs/");
    }
?>
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
    <h2>Please Enter the New Data for the Book</h2> <!--Sanitized, but text box-->
    <form>
        <div class="form-group1">
            <label for="Title">Title</label>
            <input type="text" style="width: 200px" class="form-control" id="Title"/>
        </div>
        <div class="form-group1" style=bl>
            <label for="Author">Author</label>
            <input type="text" style="width: 200px" class="form-control" id="Author"/>
        </div>
        <div class="form-group1">
            <label for="ReadingLevel">Reading Level</label>
            <input type="number" style="width: 200px" class="form-control" id="ReadingLevel"/>
        </div>
		<div class="form-group1">
			<label for="Length">Length</label>
			<input type="number" style="width: 200px" class="form-control" id="Length"/>
		</div>
    </form>
    <form style="padding-left: 45px; width=3000px;">
        <div class="form-group21">
            <div class="col-xs-3 selectContainer">
                <label for="Popularity">Recommended</label> <!--Popular = >4 recs, Medium = 2-4 recs, Not = 0-1--> 
                <select class="form-control" id="Popularity">
                    <option value="Select">Select--</option>
                    <option value="Recommended">Recommended</option>
                    <option value="Not Recommended">Not Recommended</option>
                </select>
            </div>
        </div>
        <div class="form-group23">
            <div class="col-xs-3 selectContainer">
                <label for="Genre">Genre</label>
                <select class="form-control" id="Genre">
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
    </form>

    <form style="padding-left: 145px">
        <div class="form-group31">
            <div class="col-xs-3 selectContainer">
                <label for="Trait1">Protagonist Trait 1</label>
                <select class="form-control" id="Trait1">
                    <option value="">Choose First Trait</option>
                    <option value="Short">African American</option>
                    <option value="Short">Native American</option>
                    <option value="Medium">Mexican American</option>
                    <option value="Long">Scandinavian American</option>
                    <option value="Medium">Hispanic</option>
                    <option value="Medium">Chilean</option>
                    <option value="Long">Pakistani</option>
                    <option value="Short">Haitian</option>
                    <option value="Long">Polish</option>
                    <option value="Short">Persian</option>
                    <option value="Medium">Afghanistani</option>
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
        </div>
        <div class="form-group32">
            <div class="col-xs-3 selectContainer">
                <label for="Trait1">Protagonist Trait 2</label> 
                <select class="form-control" id="Trait2">
                    <option value="">Choose Second Trait</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Couple">Couple</option>
                </select>
            </div>
        </div>
    </form>

    <form>
        <button type="button" class="btn btn-default" id="submit">Submit</button>
        <script>
        $("#submit").click(function() {
            var oldTitle = localStorage.getItem('title');
            var oldAuthor = localStorage.getItem('author');
            var title = $("#Title").val();
            var author = $("#Author").val();
            var readingLevel = $("#ReadingLevel").val();
            var length = $("#Length").val();
            var genre = $("#Genre option:selected").text();
            var trait1 = $("#Trait1 option:selected").text();
            var trait2 = $("#Trait2 option:selected").text();
            var data = {"oldTitle": oldTitle, "oldAuthor": oldAuthor,"title": title, "author": author, "readingLevel": readingLevel, "length": length, "genre": genre, "trait1": trait1, "trait2": trait2};
            console.log(data);
            var url = "teacherEdit.php";
            $.post(url,data,function(res) {
				var newUrl = '/~ddallaga/htdocs/teacherHomeClient.php';
                console.log(res);
				window.location.href = newUrl;
            });
        });
        </script>
    </form>
</div> 
</body>