
<!--This page is login in page-->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
    <title>Instructor Login</title>
    <link rel="stylesheet" href="index.css" type="text/css" />
    <link rel="stylesheet" href="form.css" type="text/css" />
</head>
<body>
<div class="container">
    <div class="header">
        <h1 class="header-heading">Login</h1>
    </div>
    <div class="cssmenu">
        <ul>
            <li><a href="index.html">Home</a></li>
        </ul>
    </div>

<!--    information verification-->
    <?php
    $usernameErr = $emailErr = $codeErr = $passwordErr = "";
    $username = $email = $code = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $usernameErr = "Username required.";
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email required.";
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($_POST["code"])) {
            $codeErr = "Code required";
        } else {
            $code = test_input($_POST["code"]);
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Password required";
        } else {
            $password = test_input($_POST["password"]);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

<!--    login form-->
    <div class="content">
        <div class="main">
            <center>
                <div class="form-style-10">
                    <h1>Log In<span>Login to enroll courses!</span></h1>
                    <form action="loginaccount.php" method="post">
                        <div class="section">Username &amp; Password</div>
                        <div class="inner-wrap">
                            <label>Username *<input type="text" name="username" />
                                <span class="error"><?php echo $usernameErr;?></span></label>
                            <label>Password *<input type="password" name="password" />
                                <span class="error"><?php echo $passwordErr;?></span></label>
                        </div>

                        <div class="button-section">
                            <input type="submit" name="Log In" />
                            <span class="privacy-policy">
                                </span>
                        </div>
                    </form>
                </div>
            </center>
        </div>
    </div>

</div>
</body>
</html>