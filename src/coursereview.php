
<!--This page shows course list.-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Courses System</title>
    <link rel="stylesheet" href="courseview.css" type="text/css" />
    <link rel="stylesheet" href="List.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="header">
        <h1 class="header-heading">Courses System</h1>
    </div>
    <div class="cssmenu">
        <ul>
            <li><a href="index.html">Log out</a></li>
            <li><a href="cart.php?userid=<?php echo $_GET["userid"]?>">Cart</a></li>
            <li><a href="enrolldetail.php?userid=<?php echo $_GET["userid"]?>">Enrolled Courses</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="main">
            <div class="w3-container">
                <h2>Course List</h2>
                <p>Here is all of the courses you can enroll.</p>
                <ul class="w3-ul w3-card-4">
<!--                    connect to course list DB-->
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
                    $query1 = "SELECT * FROM courses.courses";

                    $result = $conn->query($query1);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){

                            echo "<a href=\"coursedetail.php?userid={$_GET["userid"]}&id={$row["id"]}\"><li class=\"w3-bar\">";
                            echo "<span class=\"w3-bar-item w3-button w3-white w3-xlarge w3-right\">→</span>";
//                            echo "<span class=\"w3-bar-item w3-button w3-xlarge w3-right\"><a href=\"coursedetail.php?id={$row["id"]}\">→</a></span>";
                            echo "<img src={$row["imagepath"]} class=\"w3-image-bar-item w3-circle w3-hide-small\" style=\"width:140px\">";
                            echo "<div class=\"w3-bar-item\">";
                            echo "<span class=\"w3-large\">";
                            echo $row["coursename"];
                            echo "</span><br>";
                            echo "<span>";
                            echo $row["description"];
                            echo "</span>";
                            echo "</div>";
                            echo "</li></a>";
                        }
                    }
                    else{
                        echo "No result.";
                    }

                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>