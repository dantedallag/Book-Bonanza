<?php
$studentName = $_POST['studentName'];
$host = "dbserver.engr.scu.edu";
$user = "ddallaga";
$password = "00001033223";
$database = "sdb_ddallaga";
$port = 3306;
$connection = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_error($connection));
if(!$connection) {
    echo "Error connecting";
}


$result = mysqli_query($connection, "SELECT title,author,lexile,page_length,genre,trait1,trait2 FROM books INNER JOIN chosen ON chosen.book_id = books.id INNER JOIN users ON ('". $studentName . "' = users.person_name AND users.id = chosen.user_id)"); 


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
           // echo "<td>" . $row['recommended'] . "</td>";
            echo "<td><button type='submit' class='btn btn-default' id='edit" . $count . "' align='center;'>Edit</button>";
            echo "<script>
                $('#edit" . $count ."').click(function() {
                    var title = $('#title" . $count . "').text();
                    var author = $('#author" .$count . "').text();
                    localStorage.setItem('title', title);
                    localStorage.setItem('author', author);
                    console.log(title);
                    console.log(author);
                    var newUrl = 'http://linux.students.engr.scu.edu/~ddallaga/htdocs/TeacherEdit.html';
                    window.location.href = newUrl;
                });
            </script>";
            echo "<td><button type='submit' class='btn btn-default' id='delete' align='center;'>Delete</button></td>";
            echo "</tr>";
            $count = $count + 1;
    }
}
mysqli_close($connection);
?>