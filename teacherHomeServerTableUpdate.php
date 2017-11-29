<?php
//update table
include "credentials.php";
$connection = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_error($connection));
if(!$connection) {
    echo "Error connecting";
}

if(isset($_POST['title'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $result = mysqli_query($connection,"DELETE FROM books WHERE title = '" . $title . "' AND author = '" . $author . "'");
    echo mysqli_error($connection);
    $result = mysqli_query($connection, "SELECT title,author,lexile,page_length,genre,trait1,trait2,recommendations FROM books");
    echo mysqli_error($connection);
} 
else { 
    $studentName = $_POST['studentName'];
    if($studentName == "All Books") {
        $result = mysqli_query($connection, "SELECT title,author,lexile,page_length,genre,trait1,trait2,recommendations FROM books");
    } else {
        $studentName = $_POST['studentName'];
        $result = mysqli_query($connection, "SELECT title,author,lexile,page_length,genre,trait1,trait2,recommendations FROM books INNER JOIN chosen ON chosen.book_id = books.id INNER JOIN users ON ('". $studentName . "' = users.person_name AND users.id = chosen.user_id)"); 
    }
}

$count = 0;
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td id='title" . $count . "'>" . $row['title'] . "</td>";
            echo "<td id='author" . $count . "'>" . $row['author'] . "</td>";
            echo "<td>" . $row['lexile'] . "</td>";
            echo "<td>" . $row['page_length'] . "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['trait1'] . "</td>";
            echo "<td>" . $row['trait2'] . "</td>";
            echo "<td>" . $row['recommendations'] . "</td>";
            echo "<td><button type='submit' class='btn btn-default' id='edit" . $count . "' align='center;'>Edit</button>";
            echo "<script>
            $(document).on('click','#edit" . $count . "', function()  {
                //edit button functionality
                var title = $('#title" . $count . "').text();
                var author = $('#author" .$count . "').text();
                localStorage.setItem('title', title);
                localStorage.setItem('author', author);
                var newUrl = 'TeacherEdit.html';
                window.location.href = newUrl;
            });
            </script>";
            echo "<td><button type='submit' class='btn btn-default' id='delete" . $count . "' align='center;'>Delete</button></td>";
            echo "<script>
            //delete button functionality
            $(document).on('click', '#delete," . $count . "', function() {
                var title = $('#title" . $count . "').text();
                var author = $('#author" . $count . "').text();
                loadXMLDocDelete(title,author);
            });
			</script>";
            echo "</tr>";
            $count = $count + 1;
    }
}
mysqli_close($connection);
?>