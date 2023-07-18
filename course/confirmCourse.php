<?php
    include("../config.php");

    $title=$_POST['CourseTitle'];
    echo $title;
    $duration =$_POST['CourseDuration'];
    $price=$_POST['CoursePrice'];
    $stream=$_POST['stream'];

    $sql= "INSERT INTO course_record(Title,Duration,Price,streamID) VALUES('$title','$duration','$price','$stream')";
    $conn->query($sql);

    header('location: displayCourse.php');


?>
