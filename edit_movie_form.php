<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Movie</h1>

        <?php
        
        $conn = mysqli_connect("localhost", "root", "", "cinema");

        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['movie_id'])) {
            $movieId = mysqli_real_escape_string($conn, $_GET['movie_id']);

            
            $sql = "SELECT id, title, description, release_date, duration, poster_url FROM movies WHERE id='$movieId'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                echo "<form action='edit_movie_process.php' method='post'>";
                echo "<input type='hidden' name='movie_id' value='{$row['id']}'>";
                echo "<label for='title'>Title:</label>";
                echo "<input type='text' name='title' value='{$row['title']}' required>";
                echo "<label for='description'>Description:</label>";
                echo "<textarea name='description' rows='4' required>{$row['description']}</textarea>";
                echo "<label for='release_date'>Release Date:</label>";
                echo "<input type='date' name='release_date' value='{$row['release_date']}' required>";
                echo "<label for='duration'>Duration (in minutes):</label>";
                echo "<input type='number' name='duration' value='{$row['duration']}' required>";
                echo "<label for='poster_url'>Poster URL:</label>";
                echo "<input type='url' name='poster_url' value='{$row['poster_url']}' required>";
                echo "<button type='submit'>Update Movie</button>";
                echo "</form>";
            } else {
                echo "<p>Movie not found.</p>";
            }
        } else {
            echo "<p>Invalid request.</p>";
        }

        
        mysqli_close($conn);
        ?>

        <p><a href="admin_dashboard.php">Back to Admin Dashboard</a></p>
    </div>
</body>
</html>
