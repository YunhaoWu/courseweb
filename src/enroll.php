
<!--Enroll all courses in the cart. Add courses in enrollment DB and deleted from cart DB-->
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
$query1 = "select courseid FROM courses.cart where userid = {$_GET["userid"]}";
$success = true;

$result = $conn->query($query1);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $query2 = "DELETE FROM courses.cart WHERE userid={$_GET["userid"]} and courseid={$row["courseid"]}";
        $query3 = "Insert into courses.enrollment (enuserid, encourseid) values ({$_GET["userid"]},{$row["courseid"]})";
        if(!$conn->query($query2) || !$conn->query($query3)){
            $success = false;
            break;
        }
    }
} else {
    echo "<script type='text/javascript'>alert(\"Enroll Failed.\")";
}

if($success){
    echo "<script type='text/javascript'>alert(\"Success!\");
                 window.location.href = \"enrolldetail.php?userid={$_GET["userid"]}\"</script>";
}



?>