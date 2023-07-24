<?php

include "config.php";
$sql = "SELECT * FROM login";
session_start();
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    if ($row['UserName'] == $_SESSION['userName'] && $row['Password'] == $_SESSION['passWord'] && $row['UserType'] == 1) {
?>
        <a href="student/displayStudent.php">Student List</a>
        <a href="stream/addStream.php">Add stream</a>
        <a href="payment/displayPayment.php">Add Payment</a>
        <a href="logout.php">Log Out</a>
    <?php
    } elseif ($row['UserName'] == $_SESSION['userName'] && $row['Password'] == $_SESSION['passWord'] && $row['UserType'] == 0) {
    ?>
        <a href="student/studentForm.php">Add Student</a>
        <a href="index.php">Log in</a>
        <a href="logout.php">Log Out</a>

<?php
    }
}
?>