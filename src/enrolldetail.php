
<!--This implement enrolled courses list page-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Instructor Login</title>
    <link rel="stylesheet" href="courseview.css" type="text/css" />
    <link rel="stylesheet" href="List.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="header">
        <h1 class="header-heading">Enrollment</h1>
    </div>
    <div class="cssmenu">
        <ul>
            <li><a href="index.html">Log out</a></li>
            <li><a href="coursereview.php?userid=<?php echo $_GET["userid"]?>">Courses List</a></li>
            <li><a href="cart.php?userid=<?php echo $_GET["userid"]?>">Cart</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="main">
<!--            connect to enrollment DB to withdraw course information-->
            <?php

            $servername = "127.0.0.1:3306";
            $username = "root";
            $dbpassword = "1234";
            $dbname = "courses";

            $haveresultflag=false;
            // Create connection
            $conn = new mysqli($servername, $username, $dbpassword, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $query1 = "SELECT co.id, co.coursename, co.description, co.imagepath
                            FROM courses.enrollment en,courses.courses co where en.encourseid=co.id and en.enuserid={$_GET["userid"]}";

            $result1 = $conn->query($query1);
            if ($result1->num_rows > 0) {
            ?>
            <h2>Enrolled Courses</h2>
            <ul class="w3-ul w3-card-4">
                <?php
                while($row = $result1->fetch_assoc()){
                    ?>
                    <a href="coursedetail.php?userid=<?php echo $_GET["userid"] ?>&id=<?php echo $row["id"] ?>">
                        <li class="w3-bar">
                            <img src=<?php echo $row["imagepath"]?> class="w3-image-bar-item w3-circle w3-hide-small" style="width:140px" />
                            <div class="w3-bar-item">
                                <span class="w3-xlarge"><?php echo $row["coursename"] ?></span>
                                <br />
                                <span><?php echo $row["description"]?></span>
                            </div>
                        </li>
                    </a>
                    <?php
                }
                }
                else{
                    echo "<h2>No Course Enrolled.</h2>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>



</div>
</body>
</html>
