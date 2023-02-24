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

$sql = "SELECT * FROM detailed_report";
$result = $conn->query($sql);
$entries = array();
if ($result->num_rows > 0) {
    // output data of each row
    $x = 0;
    while($row = $result->fetch_assoc()) {
        $entry = array();
        $entry[0] = $row["id"];
        $entry[1] = $row["section"];
        $entry[2] = $row["ticketNumber"];
        $entry[3] = $row["item"];
        $entry[4] = $row["amount"];
        $entry[5] = $row["user"];
        $entry[6] = $row["time"];
        $entry[7] = $row["date"];
        $entries[$x] = $entry;
        $x += 1;
    }
    echo json_encode($entries);
}

$conn->close();
?>