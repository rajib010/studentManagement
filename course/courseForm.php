<?php
include("../navbar.php");
?>

<form action="confirmCourse.php" method="post">
    Course Title: <br>
    <input type="text" name="CourseTitle"> <br> <br>
    Duration: <br>
    <input type="text" name="CourseDuration"> <br> <br>
    Course Price: <br>
    <input type="text" name="CoursePrice"> <br> <br>

    <button type="submit">Submit</button>

</form>