<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $conn = mysqli_connect("localhost", "root", "", "cinema");

            
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            
            $sql = "SELECT username, password, is_admin FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                
                $row = mysqli_fetch_assoc($result);
                if ($password == $row['password']) {
                    
                    session_start();
                    $_SESSION['username'] = $row['username'];
                    if ($row['is_admin']) {
                        
                        header("Location: admin_dashboard.php");
                    } else {
                        
                        header("Location: user_dashboard.php");
                    }
                } else {
                    
                    echo "<p>Invalid password. Please try again.</p>";
                }
            } else {
                
                echo "<p>User not found. Please check your username.</p>";
            }

            
            mysqli_close($conn);
        }
        ?>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="sign_up.php">Sign up here</a>.</p>
    </div>
</body>
</html>
