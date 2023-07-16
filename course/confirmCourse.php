<?php
    include("../config.php");

    $title=$_POST['CourseTitle'];
    echo $title;
    $duration =$_POST['CourseDuration'];
    $price=$_POST['CoursePrice'];

    $sql= "INSERT INTO course_record(Title,Duration,Price) VALUES('$title','$duration','$price')";
    $conn->query($sql);

    header('location: displayCourse.php');


?>
