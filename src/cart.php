
<!--This page implements cart page-->
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
        <h1 class="header-heading">Course Details</h1>
    </div>
    <div class="cssmenu">
        <ul>
            <li><a href="index.html">Log out</a></li>
            <li><a href="coursereview.php?userid=<?php echo $_GET["userid"]?>">Courses List</a></li>
            <li><a href="enrolldetail.php?userid=<?php echo $_GET["userid"]?>">Enrolled Courses</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="main">
<!--                connect to DB get the stuff inside the cart-->
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
                $query1 = "SELECT co.id, co.coursename, co.price, co.imagepath
                            FROM courses.cart ca,courses.courses co where ca.courseid=co.id and ca.userid={$_GET["userid"]}";

                $result1 = $conn->query($query1);
                if ($result1->num_rows > 0) {
                    $haveresultflag=true;
                    ?>
                    <h2>Cart</h2>
                    <p>Here are the courses you plan to enroll.</p>
                    <ul class="w3-ul w3-card-4">
<!--                        while loop shows the results-->
                    <?php
                    while($row = $result1->fetch_assoc()){
                        ?>

                        <li class="w3-bar">
                            <script type='text/javascript'>
                                function remove(){
                                    window.location.href='cartremove.php?userid=<?php echo $_GET["userid"]?>&id=<?php echo $row["id"]?>';
                                }
                            </script>
                            <span onclick="this.parentElement.style.display='none';remove()" class="w3-bar-item w3-button w3-white w3-xlarge w3-right">x</span>

                            <a href="coursedetail.php?userid=<?php echo $_GET["userid"] ?>&id=<?php echo $row["id"] ?>">
                            <img src=<?php echo $row["imagepath"]?> class="w3-image-bar-item w3-circle w3-hide-small" style="width:140px">
                            <div class="w3-bar-item">
                                <span class="w3-xlarge"><?php echo $row["coursename"] ?></span>
                                <br/>
                                <span class="w3-text-orange">$ <?php echo $row["price"]?></span>
                            </div>
                         </li>
                        </a>
                    <?php
                    }
                }
                else{
                    echo "<h2>No course selected.</h2>";
                    echo "<h2 class=\"w3-xxlarge w3-right\">Total price: </h2> <br /><br /><br />";
                    echo "<p class=\"w3-xlarge w3-right-align w3-text-orange\">$ 0.00</p>";
                }

                if($haveresultflag === TRUE) {
                ?>
                </ul>
                <br />
                <br />
                <button onclick="window.location.href='enroll.php?userid=<?php echo $_GET["userid"]?>'" class="w3-button w3-orange w3-padding-large w3-hover-black">Enroll All</button>
                <br />
                <br />
                <h2 class="w3-xxlarge w3-right">Total price: </h2>
                <br /><br /><br />

                    <?php
                    $query2 = "SELECT sum(co.price) FROM courses.courses co,courses.cart ca where ca.courseid = co.id and userid={$_GET["userid"]};";
                    $result2 = $conn->query($query2);
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo "<p class=\"w3-xlarge w3-right-align w3-text-orange\">$ {$row["sum(co.price)"]}</p>";
                        }
                    }
                }
                ?>
        </div>
    </div>
</div>



</div>
</body>
</html>
