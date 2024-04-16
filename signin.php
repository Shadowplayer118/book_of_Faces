<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Form</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form method="post" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Sign Up" name="signup">
    </form>

    <?php
    if(isset($_POST['signup'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'book_of_faces');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert new username and password into the 'users' table
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Sign up successful";
            header('location:login.php');
            // Redirect to a new page or perform other actions here
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
