<?php
// Include the database connection
$conn = new mysqli("localhost", "root", "", "car_website_db");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $username;
            header("Location: index.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <label for="username">Username</label>
            <input type="text" name="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
