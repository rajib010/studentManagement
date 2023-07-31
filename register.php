<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
<div class="container">
    <br> <br>

<form action="" class="form-control" method="post">
    <label for="username" id="username">Username</label>
    <input type="text" name="username" id="username"> <br> <br>

    <label for="password" id="password">Password</label>
    <input type="password" name="password" id="password"> <br> <br>

    <label for="Conpassword" id="Conpassword">Confirm Password</label>
    <input type="password" name="ConPassword" id="Conpassword"> <br> <br>

    <label for="email" id="email">Email</label>
    <input type="email" name="email" id="email"> <br> <br>

    <label for="phone" id="phone">Phone Number</label>
    <input type="phone" name="phone" id="phone"> <br> <br>

    <button type="submit" name="register">Register</button>
</form>
</div>

<?php
include "config.php";

if (isset($_POST['register'])) {
    include "config.php";
    $username = $_POST['username'];
    $conPassword=$_POST['ConPassword'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];


    //validating passwords...
    if ($password != $conPassword) {
        // echo $password;
        // echo $conPassword;

        echo '<script> alert("Password does not match".);</script>';
      }
      
    elseif($password==$conPassword){
        $sql = "INSERT INTO login(UserName,Password,Phone,Email) VALUES('$username','$password','$phone','$email')";
        $conn->query($sql);
        header("location: index.php");
    }
}
?>