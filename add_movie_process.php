<?php

$conn = mysqli_connect("localhost", "root", "", "cinema");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $releaseDate = mysqli_real_escape_string($conn, $_POST['release_date']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $posterUrl = mysqli_real_escape_string($conn, $_POST['poster_url']);

    
    $sql = "INSERT INTO movies (title, description, release_date, duration, poster_url) VALUES ('$title', '$description', '$releaseDate', '$duration', '$posterUrl')";

    if (mysqli_query($conn, $sql)) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>
