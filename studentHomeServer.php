<?php
    //$_POST = json_decode(file_get_contents('php://input'), true);
    session_start();
    if( !isset($_SESSION['credentials']) || $_SESSION['credentials'] == true) {
         header("Location: http://linux.students.engr.scu.edu/~ddallaga/htdocs/");
    }
    $studentName = $_SESSION['name'];
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
    <th>Recommended</th>
    <th>Recommendations</th>
    </tr>
    </thead>
    <tbody>";

    $result = mysqli_query($connection, "SELECT title,author,lexile,page_length,genre,trait1,trait2,recommendations FROM books INNER JOIN chosen ON chosen.book_id = books.id INNER JOIN users ON ('". $studentName . "' = users.person_name AND users.id = chosen.user_id)"); 

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
                echo "<td>"  . $row['recommendations'] . "</td>";
                echo "<td><button type='submit' class='btn btn-default' id='recommend" . $count . "'align='center;'>Recommend</button></td>";
                echo "<script>
                console.log('hello');
                $(document).on('click', '#recommend" . $count . "', function() {
                    var title = $('#title" . $count . "').text();
                    var author = $('#author" . $count . "').text();
                    console.log('hey');
                    var url = 'Recommend.php';
                    var data = {'title': title, 'author': author};
                    console.log(data);
                    $.post(url,data,function(res) { 
                        console.log(res);
                        console.log('yay recommended!');
                        var studentName = localStorage.getItem('name');
                        $('#bookTable').empty();
                        loadXMLDoc(studentName);
                    });
                });
            </script>";
            echo "<script>
            console.log('wowowowo');
            </script>";
            echo "</tr>";
            $count = $count + 1;
        }
    } else {
        echo "You have not chosen any books yet";
    }
    mysqli_close($connection);
    echo "</tbody> </table>";
?>