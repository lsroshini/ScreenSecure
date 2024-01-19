<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Booking Confirmation</h1>

        <?php
        
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "cinema");

        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num_tickets'], $_POST['card_number'], $_POST['cvv'], $_POST['movie_id'])) {
            $numTickets = mysqli_real_escape_string($conn, $_POST['num_tickets']);
            $cardNumber = mysqli_real_escape_string($conn, $_POST['card_number']);
            $expiryDate = mysqli_real_escape_string($conn, $_POST['cvv']);
            $movieId = mysqli_real_escape_string($conn, $_POST['movie_id']);
            $username = $_SESSION['username'];

            
            $movie = "SELECT poster_url, title FROM MOVIES WHERE id=$movieId";
            $movie = mysqli_query($conn,$movie);
            $movie = mysqli_fetch_assoc($movie);
            $url = $movie['poster_url'];
            $movie = $movie['title'];
            $paymentSql = "INSERT INTO payments (card_number, cvv, username) VALUES ('$cardNumber', '$expiryDate', '$username')";
            if (mysqli_query($conn, $paymentSql)) {
                $paymentId = mysqli_insert_id($conn);

                
                $amount=$numTickets * 200;
                $ticketSql = "INSERT INTO bookings (movie_id, payment_id, num_tickets, amount) VALUES ('$movieId', '$paymentId', '$numTickets', '$amount')";
                if (mysqli_query($conn, $ticketSql)) {
                    echo "<p>Booking successful!</p>";
                    echo "<img class='movie-poster' src='$url'>";
                    echo "<p>Number of Tickets: $numTickets</p>";
                    echo "<p>Movie : $movie</p>";
                    echo "<p>Payment ID: $paymentId</p>";
                } else {
                    echo "Error: " . $ticketSql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error: " . $paymentSql . "<br>" . mysqli_error($conn);
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
