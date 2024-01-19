<?php

$conn = mysqli_connect("localhost", "root", "", "cinema");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = mysqli_real_escape_string($conn, $_POST['movie_id']);

    
    $sql = "DELETE FROM movies WHERE id='$movieId'";

    if (mysqli_query($conn, $sql)) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>
