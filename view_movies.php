<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Current Movies</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Current Movies</h1>

        <?php
        
        $conn = mysqli_connect("localhost", "root", "", "cinema");

        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $sql = "SELECT id, title, description, poster_url, release_date, duration FROM movies";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>";
                echo "<div class='movie-info'>";
                echo "<img class='movie-info' src='{$row['poster_url']}' alt='{$row['title']}' class='movie-poster'>";
                echo "<strong>{$row['title']}</strong> - {$row['description']}<br>";
                echo "Release Date: {$row['release_date']}<br>";
                echo "Duration: {$row['duration']} minutes<br>";
                echo "<a href='edit_movie.php?movie_id={$row['id']}'>Edit</a>";
                echo "</div>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No movies found.</p>";
        }

        
        mysqli_close($conn);
        ?>

        <p><a href="admin_dashboard.php">Back to Admin Dashboard</a></p>
    </div>
</body>
</html>

