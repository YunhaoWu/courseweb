
<!--This document implements remove items of cart-->
<?php

$servername = "127.0.0.1:3306";
$username = "root";
$dbpassword = "1234";
$dbname = "courses";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query1 = "DELETE FROM courses.cart WHERE courseid={$_GET["id"]};";

if ($conn->query($query1) === TRUE) {
    echo "<script type='text/javascript'>
                 window.location.href='cart.php?userid={$_GET["userid"]}';</script>";
} else {
    echo "<script type='text/javascript'>alert(\"Error. {$conn->error}. Please Refresh.\")</script>";
}


?>