<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Movie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Delete Movie</h1>
        <form action="delete_movie_process.php" method="post">
            <label for="movie_id">Select Movie:</label>
            <select name="movie_id" required>
                <?php
                
                $conn = mysqli_connect("localhost", "root", "", "cinema");

                
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                
                $sql = "SELECT id, title FROM movies";
                $result = mysqli_query($conn, $sql);

                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['title']}</option>";
                }

                
                mysqli_close($conn);
                ?>
            </select>
            <button type="submit">Delete Movie</button>
        </form>
        <p><a href="admin_dashboard.php">Back to Admin Dashboard</a></p>
    </div>
</body>
</html>
