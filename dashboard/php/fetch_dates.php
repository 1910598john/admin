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

$sql = "SELECT date FROM detailed_report";

$result = $conn->query($sql);
$dates = array();

if ($result->num_rows > 0) {
    // output data of each row
    $x = 0;
    while($row = $result->fetch_assoc()) {
        $dates[$x] = $row['date'];
        $x += 1;
    }
    echo json_encode($dates);
} 

$conn->close();
?>