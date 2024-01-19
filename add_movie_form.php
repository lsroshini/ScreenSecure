<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Movie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Add New Movie</h1>
        <form action="add_movie_process.php" method="post">
            <label for="title">Title:</label>
            <input type="text" name="title" required>
            <label for="description">Description:</label>
            <textarea name="description" rows="4" required></textarea>
            <label for="release_date">Release Date:</label>
            <input type="date" name="release_date" required>
            <label for="duration">Duration (in minutes):</label>
            <input type="number" name="duration" required>
            <label for="poster_url">Poster URL:</label>
            <input type="url" name="poster_url" required>
            <button type="submit">Add Movie</button>
        </form>
        <p><a href="admin_dashboard.php">Back to Admin Dashboard</a></p>
    </div>
</body>
</html>
