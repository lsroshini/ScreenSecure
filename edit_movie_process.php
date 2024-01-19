<?php

$conn = mysqli_connect("localhost", "root", "", "cinema");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = mysqli_real_escape_string($conn, $_POST['movie_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $releaseDate = mysqli_real_escape_string($conn, $_POST['release_date']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $posterUrl = mysqli_real_escape_string($conn, $_POST['poster_url']);

    
    $sql = "UPDATE movies SET title='$title', description='$description', release_date='$releaseDate', duration='$duration', poster_url='$posterUrl' WHERE id='$movieId'";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_movies.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>
