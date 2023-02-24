<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['name'])) {
    //variables
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    
    $sql = "INSERT INTO products (name, description, price, discount)
    VALUES ('$name', '$description', '$price', '$discount')";

    if ($conn->query($sql) === TRUE) {
        echo 'Item inserted.';
    } else {
        echo 'An error occured!';
    }
}

$conn->close();
?>