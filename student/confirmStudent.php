<?php
    include ("../config.php");
    $name=$_POST['sName'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $phone=$_POST['pNumber'];
    $email=$_POST['email'];
    $sql= "INSERT INTO student_record(Name, Gender, Address, Contact, Email) VALUES('$name','$gender','$address','$phone','$email')";
    $conn->query($sql);

    header('location: displayStudent.php');
?>