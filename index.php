<?php
include "config.php";
session_start();

//code for signup option...
if (isset($_POST['SignUpBtn'])) {
    header('location: ./register.php');
}

//code for login option...
elseif (isset($_POST['LoginBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `login` WHERE UserName='$username'";
    // $result = $conn->query($sql);
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    //if no user found..
    if (empty($row)) {
        echo "<script> alert('user not found')</script>";
    }
    //if user found
    else if ($username == $row['UserName']) {
        //if password doesnot matches
        if ($password != $row['Password']) {
            echo "<script> alert('invalid password')</script>";
        } else if ($password == $row['Password']) {
            //checking if super user
            if ($row['UserType'] == 1) {
                $_SESSION['userName'] = $username;
                $_SESSION['passWord'] = $password;
                $_SESSION['userLevel'] = 1;
                header('location: ./pages/dashboard.php');
            } // for normal user
            elseif ($row['UserType'] == 0) {
                $_SESSION['userName'] = $username;
                $_SESSION['passWord'] = $password;
                $_SESSION['userLevel'] = 0;
                header('location: ./pages/dashboard.php');
            } else {
                echo "<script> alert('user not found')</script>";
            }
        }
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <!doctype html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>Student Management</title>

        <link rel="stylesheet" href="./css/style.css">

    </head>

    <body> <!-- partial:index.partial.html -->

        <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>

            <div class="signin">

                <div class="content">

                    <h2>Sign In</h2>

                    <div class="form">
                        <form action="index.php" method="post">
                            <div class="inputBox">

                                <input type="text" name="username" required> <i>Username</i>

                            </div>

                            <div class="inputBox">

                                <input type="password" name="password" required> <i>Password</i>

                            </div>

                            <div class="links">
                                <a href="./forgotPassword/sendCodeTo.php">Forgot Password?</a>
                                <a href="./register.php">Signup</a>

                            </div>

                            <div class="inputBox">
                                <button type="submit" class="login-btn" name="LoginBtn">Login</button>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </section> <!-- partial -->

    </body>

    </html>
    <!-- partial -->

</body>

</html>