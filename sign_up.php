<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $conn = mysqli_connect("localhost", "root", "", "cinema");

            
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Account created successfully. <a href='login.php'>Login</a> to continue.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            
            mysqli_close($conn);
        }
        ?>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>
