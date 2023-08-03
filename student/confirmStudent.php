<?php
    include ("../config.php");
    $name=filteration($_POST['sName']);
    $gender=filteration($_POST['gender']);
    $address=filteration($_POST['address']);
    $phone=$_POST['pNumber'];
    echo $phone;
    die();
    $email=filteration($_POST['email']);
    $sql= "INSERT INTO student_record(Name, Gender, Address, Contact, Email) VALUES('$name','$gender','$address','$phone','$email')";
    $conn->query($sql);

    $last_id = $conn->insert_id;
    $interestID=$_POST['interest'];
    for($i=0;$i< count($interestID);$i++){
        $sql1="INSERT INTO student_interest(studentID,interestID) VALUES($last_id,$interestID[$i])";
        $conn->query($sql1);        
    } 
    header('location: displayStudent.php');
