<?php
include "../config.php";
include "navbar.php";

if (isset($_POST["submitBtn"])) {
    $username = $_SESSION['userName'];
    $password = $_SESSION['passWord'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    if ($currentPassword != $password) {
        echo "<script> alert('Invalid password')</script>";
    } else if ($currentPassword == $password) {
        //if both the password doesnot match...
        if ($newPassword != $confirmPassword) {
            echo "<script> alert('Password doesnot match')</script>";
        } //if both the password are same...
        else if ($newPassword == $confirmPassword) {
            $sql = "UPDATE `login` SET `Password`='$newPassword' WHERE `UserName`='$username'";
            $result = $conn->query($sql);
            header('location:./dashboard.php');
        }
    }
}
?>
<div class="container">
    <br><br>
    <form action="" class="form-control" method="post">
        <span>Current Password</span>
        <input type="text" name="currentPassword"> <br><br>
        <span>New Password</span>
        <input type="password" name="newPassword"> <br> <br>
        <span>Confirm Password</span>
        <input type="password" name="confirmPassword"> <br> <br>
        <button type="submit" name="submitBtn">Submit</button>
    </form>
</div>