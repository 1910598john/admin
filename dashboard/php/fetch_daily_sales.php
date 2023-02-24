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


$date = $_POST['date'];
$mon = $_POST['mon'];

$sql = "SELECT id, section, amount FROM detailed_report WHERE date LIKE '%$mon%' AND date LIKE '%$date%'";

$result = $conn->query($sql);

$amountList = array();
$sectionList = array();
$itemsList = array();
if ($result->num_rows >= 1) {
    // output data of each row
    $x = 0;
    while($row = $result->fetch_assoc()) {
        $amountList[$x] = $row['amount'];
        $sectionList[$x] = $row['section'];
        $x += 1;
    }
    $itemsList[0] = $amountList;
    $itemsList[1] = $sectionList;
    echo json_encode($itemsList);
}


$conn->close();
?>