<?php
    include("../config.php");

    $title=filteration($_POST['CourseTitle']);
    $duration =filteration($_POST['CourseDuration']);
    $price=filteration($_POST['CoursePrice']);
    $stream=filteration($_POST['stream']);

    $sql= "INSERT INTO course_record(Title,Duration,Price,streamID) VALUES('$title','$duration','$price','$stream')";
    $conn->query($sql);

    header('location: displayCourse.php');


?>
