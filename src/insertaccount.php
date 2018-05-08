
<!--This page is for inserting new account information-->
<?php

$servername = "127.0.0.1:3306";
$dbusername = "root";
$dbpassword = "1234";
$dbname = "courses";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query1 = "select * FROM courses.invitedcode";

$result1 = $conn->query($query1);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        if ($row["code"] == $_POST["code"]) {
            $query2 = sprintf("Insert into courses.users (username, password, email) values ('%s','%s','%s');",
                $_POST["username"],
                $_POST["password"],
                $_POST["email"]);
            if ($conn->query($query2) === TRUE) {
                echo "<script type='text/javascript'>alert(\"New record created successfully\"); 
                window.location.href = 'login.php'</script>";
                //echo "</script>";

            } else {
                echo "<script type='text/javascript'>alert(\"Create Error.\"); 
                        window.location.href = \"index.html\"</script>";
            }
        }
    }
} else {
    echo "<script type='text/javascript'>alert(\"No code in DB.\"); 
                        window.location.href = \"index.html\"</script>";
}

?>