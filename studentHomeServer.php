<?php
    error_reporting(0);
    session_start();
    $studentName = $_SESSION['name'];
    include "/htdocs/credentials.php";
    $connection = mysqli_connect($host, $user, $password, $database)
        or die("Error: " . mysqli_error($connection));
    if(!$connection) {
        echo "Error connecting";
    }
    
    $result = mysqli_query($connection, "SELECT title,author,lexile,page_length,genre,trait1,trait2,recommendations FROM books INNER JOIN chosen ON chosen.book_id = books.id INNER JOIN users ON ('". $studentName . "' = users.person_name AND users.id = chosen.user_id)"); 
    $count = 0;
    if(mysqli_num_rows($result) > 0) {
		echo "<table class='table table-striped' align='center' id='bookTable'>
		<thead>
		<tr>
		<th>Book Title</th>
		<th>Author</th>
		<th>Lexile Level</th>
		<th>Length</th>
		<th>Genre</th>
		<th>Protagonist Trait 1</th>
		<th>Protagonist Trait 2</th>
		<th>Recommendations </th>
		<th>Recommend</th>
		</tr>
		</thead>
		<tbody>";
        while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td id='title" . $count . "'>" . $row['title'] . "</td>";
                echo "<td id='author" . $count . "'>" . $row['author'] . "</td>";
                echo "<td>" . $row['lexile'] . "</td>";
                echo "<td>" . $row['page_length'] . "</td>";
                echo "<td>" . $row['genre'] . "</td>";
                echo "<td>" . $row['trait1'] . "</td>";
                echo "<td>" . $row['trait2'] . "</td>";
                echo "<td>"  . $row['recommendations'] . "</td>";
                echo "<td><button type='submit' class='btn btn-default' id='recommend" . $count . "'align='center;'>Recommend</button></td>";
                echo "<script>
                //onclick recommend action unique for each boko entry
                $(document).on('click', '#recommend" . $count . "', function() {
                    var title = $('#title" . $count . "').text();
                    var author = $('#author" . $count . "').text();
                    var url = '/htdocs/Recommend.php';
                    var data = {'title': title, 'author': author};
                    $.post(url,data,function(res) { 
                        if(res == 'already recommeded') {
                            alert('You have already recommended this book');
                            return;
                        }
                        var studentName = localStorage.getItem('name');
                        $('#bookTable').empty();
                        loadXMLDoc(studentName);
                    });
                });
            </script>";
            echo "<script>
            </script>";
            echo "</tr>";
            $count = $count + 1;
        }
    } else {
        echo "<p align='center'>You have not chosen any books yet!</p>";
    }
    mysqli_close($connection);
    echo "</tbody> </table>";
?>