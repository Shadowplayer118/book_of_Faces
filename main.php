<?php
session_start();

if(!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit;
}

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'book_of_faces');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the 'posts' table
$sql = "SELECT post_text FROM posts";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;

            
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div>Hello, <?php echo $_SESSION['username']; ?></div>

    <a href="logout.php">Log Out</a>

    <h2>Posts</h2>

    <?php
    // Display posts in cards
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="card">' . $row['post_text'] . '</div>';
        }
    } else {
        echo "No posts found.";
    }

    $conn->close();
    ?>
</body>
</html>
