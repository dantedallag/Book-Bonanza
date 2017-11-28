<?php
    session_start();
    $title = $_POST['title'];
    $author = $_POST['author'];
    $name = $_SESSION['name'];
    include "../credentials.php";
    $connection = mysqli_connect($host, $user, $password, $database)
        or die("Error: " . mysqli_error($connection));
    if(!$connection) {
        echo "Error connecting";
    }
    $results = mysqli_query($connection, "SELECT id FROM users WHERE person_name = '" . $name . "'");
    $user_id = mysqli_fetch_array($results);
    $results = mysqli_query($connection, "SELECT id FROM books WHERE title = '" . $title . "' AND author = '" . $author . "'");
    $book_id = mysqli_fetch_array($results);
    $results = mysqli_query($connection, "SELECT recommended FROM chosen WHERE user_id = '" . $user_id['id'] . "' AND book_id = '" . $book_id['id'] . "'");
    $row = mysqli_fetch_array($results);
    if($row['recommended'] == 1) {
        echo "already recommeded";
    } else {
        $results = mysqli_query($connection, "UPDATE chosen SET recommended = true WHERE book_id = '" . $book_id['id'] . "' AND user_id = '" . $user_id['id'] . "'");
        $results = mysqli_query($connection, "UPDATE books SET recommendations = recommendations + 1 WHERE id = '" . $book_id['id'] . "'");
        echo "recommendation added";
    }
    mysqli_close($connection);
?>
