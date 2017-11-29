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
       header("Location: /htdocs/");
    }
?>
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
</style>
</head>

<body>
<button class="logout" onclick="logOut()">logout</button>
<div class="container">
    <h2>Please Enter the New Data for the Book</h2> <!--Sanitized, but text box-->
    <form>
        <div class="form-group1">
            <label for="Title">Title</label>
            <input type="text" onblur="titleFilter()" style="width: 200px" class="form-control" id="Title"/>
        </div>
        <div class="form-group1" style=bl>
            <label for="Author">Author</label>
            <input type="text" onblur="authorFilter()" style="width: 200px" class="form-control" id="Author"/>
        </div>
        <div class="form-group1">
            <label for="ReadingLevel">Reading Level</label>
            <input type="number" min="1" pattern="^[1-9]\d*$"  style="width: 200px" class="form-control" id="ReadingLevel"/>
        </div>
		<div class="form-group1">
			<label for="Length">Length</label>
			<input type="number" min="1" pattern="^[1-9]\d*$"  style="width: 200px" class="form-control" id="Length"/>
		</div>
    </form>
    <form style="padding-left: 250px; width=3000px;">
        <div class="form-group23">
            <div class="col-xs-3 selectContainer">
                <label for="Genre">Genre</label>
                <select class="form-control" id="Genre">
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
    </form>

    <form style="padding-left: 145px">
        <div class="form-group31">
            <div class="col-xs-3 selectContainer">
                <label for="Trait1">Protagonist Trait 1</label>
                <select class="form-control" id="Trait1">
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
        </div>
        <div class="form-group32">
            <div class="col-xs-3 selectContainer">
                <label for="Trait1">Protagonist Trait 2</label> 
                <select class="form-control" id="Trait2">
                    <option selected='selected' value="">Choose Second Trait</option>
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
        //takes edited new book info and posts it to a php script that edits the database entry
        $("#submit").click(function() {
            var a = document.getElementById("Author").value;
            var t = document.getElementById("Title").value;
            var lex = document.getElementById("ReadingLevel").value;
            var len = document.getElementById("Length").value;
            if($.trim(a).length == 0 || $.trim(t).length == 0|| $.trim(lex).length == 0 || $.trim(len).length == 0){
                alert("You must fill in all of the fields.");
                return;
            }
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
            var url = "/htdocs/teacherEdit.php";
            $.post(url,data,function(res) {
				var newUrl = '/htdocs/teacherHomeClient.php';
				window.location.href = newUrl;
            });
        });
        </script>
    </form>
</div> 
</body>