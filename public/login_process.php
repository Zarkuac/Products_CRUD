<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "products_crud"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from form
$username = $_POST['username'];
$password = $_POST['password'];

// SQL injection prevention
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Query the database for user
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows == 1) {
    // Set session variables
    $_SESSION['username'] = $username;
    // Redirect to index.php
    header("Location: index.php");
} else {
    //echo "Login failed. Invalid username or password."
    header("Location: failed.php");
}

// Close connection
$conn->close();
?>