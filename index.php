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

$sql = "SELECT username, password FROM auth";
$result = $conn->query($sql);

//VARIABLES
if (isset($_POST['username'])){
    $uname = $_POST['username'];
    $pwd = $_POST['password'];
    $verifiedAdmin = false;

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["username"] == $uname && $row["password"] == $pwd) {
                $verifiedAdmin = true;
            } else {
                $verifiedAdmin = false;
            }
        } 
        if ($verifiedAdmin) {
            header('Location: http://localhost/admin/dashboard/');
        } else {
            header('Location: http://localhost/admin/');
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <link rel='stylesheet' type='text/css' media='screen' href='./css/main.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
<div class="login" id="login-container">
	<h1>ADMIN</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    	<input type="text" name="username" placeholder="Username" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
    </form>
</div>
<script src='main.js'></script>
</body>
</html>