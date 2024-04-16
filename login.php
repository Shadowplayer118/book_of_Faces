<!DOCTYPE html>
<html>
<head>
    <title>Sign In Form</title>
</head>
<body>
    <h2>Sign In</h2>
    <form method="post" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Sign In" name="signin">
        <a href="signin.php">SIgn Up</a>
    </form>

    <?php
session_start();

if(isset($_SESSION['username'])) {
    header('location: main.php');
    exit;
}

if(isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'book_of_faces');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the entered username and password match a record in the 'users' table
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {    
        $_SESSION['username'] = $username;
        header('location: main.php');
        exit;
    } else {
        echo "Invalid username or password";
    }

    $conn->close();
}
?>

</body>
</html>
