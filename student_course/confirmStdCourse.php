<?php
    include ("../config.php");
 
    $student=$_POST['student'];
    $course=$_POST['course'];
    $payment=$_POST['advPayment'];
    

    // $sql1=" SELECT * FROM student_course JOIN student_record ON student_course.sID=student_record.sID";
    $sql= "INSERT INTO student_course(sID, cID, Amount) VALUES('$student','$course','$payment')";
    // $conn->query($sql1);
    $conn->query($sql);
    $last_id = $conn->insert_id;
    $sql1="INSERT INTO payment_record (scID, Paid) VALUES('$last_id','$payment')";
    $conn->query($sql1);


    header("location:displayStudentCourse.php?id='$student'");
?>