<?php
    $title = $_POST['title'];
    $author = $_POST['author'];
    $readingLevel =$_POST['readingLevel'];
    $recommendations =$_POST['recommendations'];
    $length = $_POST['length'];
    $genre = $_POST['genre'];
    $trait1 = $_POST['trait1'];
    $trait2 = $_POST['trait2'];
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
    $querry = "INSERT INTO books(title,author,lexile,recommendations,page_length,genre,trait1,trait2) 
    VALUES('".$title."','".$author."','".$readingLevel."', '" .$recommendations. "','".$length."','".$genre."','".$trait1."','".$trait2."')";
    $result = mysqli_query($connection, $querry);
    mysqli_close($connection);
    echo $querry;
?>