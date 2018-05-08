
<!--This document is to verify login-->
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
$query1 = sprintf("select * FROM courses.users where username = '%s'",$_POST["username"]);

$result = $conn->query($query1);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($row["password"] == $_POST["password"]){
                echo "<script type='text/javascript'>alert(\"Successfully login\"); 
                        window.location.href = \"coursereview.php?userid={$row["userid"]}\"</script>";
        }
        else {
            echo "<script type='text/javascript'>alert(\"Login failed.\");
                        window.location.href = \"index.html\"</script>";

        }
    }
} else {
    echo "<script type='text/javascript'>alert(\"Login failed.\");
                 window.location.href = \"index.html\"</script>";
}

//echo $_POST["username"];
//echo $_POST["email"];
//echo $_POST["password"];
//echo $_POST["code"];
?>