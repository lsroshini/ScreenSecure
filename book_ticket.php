<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Ticket</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Book Ticket</h1>

        <?php
        session_start();
        
        $conn = mysqli_connect("localhost", "root", "", "cinema");

        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['movie_id'])) {
            $movieId = mysqli_real_escape_string($conn, $_GET['movie_id']);
            
            
            $userId = $_SESSION['username']; 
            $paymentSql = "SELECT id, card_number, cvv FROM payments WHERE username='$userId'";
            $paymentResult = mysqli_query($conn, $paymentSql);

            if (mysqli_num_rows($paymentResult) == 1) {
                
                $paymentRow = mysqli_fetch_assoc($paymentResult);
                $paymentId = $paymentRow['id'];
                $cardNumber = $paymentRow['card_number'];
                $expiryDate = $paymentRow['expiry_date'];
            } else {
                
                echo "<p>Please provide your payment details:</p>";
                echo "<form action='confirm_booking.php' method='post'>";
                echo "<label for='num_tickets'>Number of Tickets:</label>";
                echo "<input type='number' name='num_tickets' required>";
                echo "<label for='card_number'>Card Number:</label>";
                echo "<input type='text' name='card_number' required>";
                echo "<label for='cvv'>CVV:</label>";
                echo "<input type='text' name='cvv' required>";
                echo "<button type='submit'>Confirm Booking</button>";
                echo "<input type='hidden' name='movie_id' value='$movieId'>";
                echo "</form>";
                
                
                mysqli_close($conn);
                exit();
            }

            
            
            $movieSql = "SELECT title, description, duration, release_date, poster_url FROM movies WHERE id='$movieId'";
            $movieResult = mysqli_query($conn, $movieSql);

            if (mysqli_num_rows($movieResult) == 1) {
                $movieRow = mysqli_fetch_assoc($movieResult);
                echo "<h2>{$movieRow['title']}</h2>";
                echo "<p>Description: {$movieRow['description']}</p>";
                echo "<p>Duration: {$movieRow['duration']} minutes</p>";
                echo "<p>Release Date: {$movieRow['release_date']}</p>";
                echo "<img src='{$movieRow['poster_url']}' alt='{$movieRow['title']}' class='movie-poster'>";
                
                
                echo "<form action='confirm_booking.php' method='post'>";
                echo "<label for='num_tickets'>Number of Tickets:</label>";
                echo "<input type='number' name='num_tickets' required>";
                echo "<input type='hidden' name='card_number' value='$cardNumber'>";
                echo "<input type='hidden' name='cvv' value='$expiryDate'>";
                echo "<input type='hidden' name='movie_id' value='$movieId'>";
                echo "<input type='hidden' name='payment_id' value='$paymentId'>";
                echo "<button type='submit'>Confirm Booking</button>";
                echo "</form>";
            } else {
                echo "<p>Movie not found.</p>";
            }
        } else {
            echo "<p>Invalid request.</p>";
        }

        
        mysqli_close($conn);
        ?>

        <p><a href="user_dashboard.php">Back to User Dashboard</a></p>
    </div>
</body>
</html>
