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

//variables
if (isset($_POST['productName'])) {
    $productName = $_POST['productName'];
    $ticketNumber = $_POST['ticketNumber'];
    $time = $_POST['time'];
    $price = $_POST['price'];

    $sql = "INSERT INTO playground_time (productName, ticketNumber, time, price)
    VALUES ('$productName', '$ticketNumber', '$time', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo 'Inserted successfully!';
    } else {
        echo 'An error occured!';
    }
}

$conn->close();
?>