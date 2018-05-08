
<!--This is add to cart action-->
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
$query1 = sprintf("Insert into courses.cart (userid, courseid) values ('%s','%s');",$_GET["userid"],$_GET["id"]);

if ($conn->query($query1) === TRUE) {
    echo "<script type='text/javascript'>alert(\"Added!\");
                 window.location.href = \"coursedetail.php?userid={$_GET["userid"]}&id={$_GET["id"]}\"</script>";
} else {
    echo "<script type='text/javascript'>alert(\"Added Failed.\");
                 window.location.href = \"courseredetail.php?userid={$_GET["userid"]}&id={$_GET["id"]}\"</script>";
}


?>