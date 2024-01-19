<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the User Dashboard</h1>
        <h2>Available Movies:</h2>

        <?php
        
        $conn = mysqli_connect("localhost", "root", "", "cinema");

        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        
        $sql = "SELECT id, title, description, duration, poster_url, release_date FROM movies";
        $result = mysqli_query($conn, $sql);

        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='movie-card'>";
            echo "<img src='{$row['poster_url']}' alt='{$row['title']}' class='movie-poster'>";
            echo "<div class='movie-info'>";
            echo "<h3>{$row['title']}</h3>";
            echo "<p>Description: {$row['description']}</p>";
            echo "<p>Duration: {$row['duration']} minutes</p>";
            echo "<p>Release Date: {$row['release_date']}</p>";
            echo "<a href='book_ticket.php?movie_id={$row['id']}' class='book-button'>Book Ticket</a>";
            echo "</div>";
            echo "</div>";
        }

        
        mysqli_close($conn);
        ?>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
