
<!--This page shows course details when click course url-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Instructor Login</title>
    <link rel="stylesheet" href="index.css" type="text/css" />
    <link rel="stylesheet" href="form.css" type="text/css" />
    <link rel="stylesheet" href="List.css" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="header">
        <h1 class="header-heading">Course Details</h1>
    </div>
    <div class="cssmenu">
        <ul>
            <li><a href="index.html">Log out</a></li>
            <li><a href="coursereview.php?userid=<?php echo $_GET["userid"]?>">Courses List</a></li>
            <li><a href="cart.php?userid=<?php echo $_GET["userid"]?>">Cart</a></li>
            <li><a href="enrolldetail.php?userid=<?php echo $_GET["userid"]?>">Enrolled Courses</a></li>
        </ul>
    </div>

    <?php

    $servername = "127.0.0.1:3306";
    $dbusername = "root";
    $dbpassword = "1234";
    $dbname = "courses";

    $coursename="";
    $description="";
    $instructor="";
    $price="";
    $hour="";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query1 = sprintf("select * FROM courses.courses where id = '%s'",$_GET["id"]);

    $result1 = $conn->query($query1);

    if ($result1->num_rows > 0) {
        // output data of each row
        while($row = $result1->fetch_assoc()) {
            $coursename = $row["coursename"];
            $description = $row["description"];
            $instructor = $row["instructor"];
            $price = $row["price"];
            $hour = $row["hour"];
        }
    } else {
        echo "<script type='text/javascript'>alert(\"No records.\");
                 window.location.href = \"coursereview.php?userid={$_GET["userid"]}\"</script>";
    }
    ?>

    <div class="content">
        <div class="main">
            <div class="w3-container" id="showcase">
                <div class="w3-container" id="showcase">
                    <h1 class="w3-xxxlarge"><b><?php echo "Course {$_GET["id"]}: {$coursename}"?></b></h1>
                </div>

                <div class="w3-container" id="packages">
                    <h1 class="w3-xxlarge w3-text-orange"><b>Instructor</b></h1>
                    <hr style="width:50px;border:5px solid orange" class="w3-round">
                    <p><?php echo $instructor?></p>
                </div>

                <div class="w3-container" id="packages">
                    <h1 class="w3-xxlarge w3-text-orange"><b>Description</b></h1>
                    <hr style="width:50px;border:5px solid orange" class="w3-round">
                    <p><?php echo $description?></p>
                </div>

                <center>
                <div style="margin-top:40px" class="w3-row-padding">
                    <div class="w3-half w3-margin-bottom">
                        <ul class="w3-ul w3-light-grey w3-center">
                            <li class="w3-orange w3-xlarge w3-padding-32">Enrollment</li>
                            <li class="w3-padding-16"><?php echo $hour?> hours on-demand video</li>
                            <li class="w3-padding-16">Access on mobile and TV</li>
                            <li class="w3-padding-16">Online support</li>
                            <li class="w3-padding-16">Full lifetime access</li>
                            <li class="w3-padding-16">Certificate of Completion</li>
                            <li class="w3-padding-16">
                                <h2>$ <?php echo $price?></h2>
                                <span class="w3-opacity">per course</span>
                            </li>
                            <li class="w3-light-grey w3-padding-24">

<!--                                Check this courses status, selected (in cart) or enrolled? show the results. In order to prevent duplication -->
                                <?php
                                $query2 = "select * FROM courses.cart where userid = {$_GET["userid"]} and courseid = {$_GET["id"]}";
                                $query3 = "select * FROM courses.enrollment where enuserid = {$_GET["userid"]} and encourseid = {$_GET["id"]}";

                                $result2 = $conn->query($query2);
                                $result3 = $conn->query($query3);

                                if ($result2->num_rows > 0) {
                                    ?>
                                    <h2>Selected</h2>
                                <?php
                                } elseif($result3->num_rows > 0) {
                                    ?>
                                    <h2>Enrolled</h2>
                                <?php
                                } else {
                                    ?>
                                    <a href="<?php echo "select.php?userid={$_GET["userid"]}&id={$_GET["id"]}"?>">
                                        <button class="w3-button w3-orange w3-padding-large w3-hover-black">Add to Cart</button>
                                    </a>
                                <?php
                                }
                                ?>

                            </li>
                        </ul>
                    </div>
                </div>
                </center>
            </div>
        </div>
    </div>

</div>
</body>
</html>