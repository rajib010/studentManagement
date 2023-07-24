<form action="" method="post">
    <label for="username" id="username">Username</label>
    <input type="text" name="username" id="username"> <br> <br>

    <label for="password" id="password">Password</label>
    <input type="password" name="password" id="password"> <br> <br>

    <button type="submit" name="LoginBtn">Login</button>
    <button type="submit" name="SignUpBtn">Sign Up</button>

</form>

<?php
include "config.php";
session_start();

//code for signup option...
if (isset($_POST['SignUpBtn'])) {
    header('location: register.php');
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
        echo "user not found";
    }
    //if user found
    else {

        //if password matches
        if ($row['Password'] == $password) {

            //checking if super user
            if ($row['UserType'] == 1) {
                $_SESSION['userName'] = $username;
                $_SESSION['passWord'] = $password;
                header('location: admin_panel/index.php');
            }else{// for normal user

                $_SESSION['userName'] = $username;
                $_SESSION['passWord'] = $password;
                header('location: dashboard.php'); 
            }
        }
        //if password doesnot matches
        elseif ($row['Password'] != $password) {
            echo "invalid password";
        }
    }
}



?>