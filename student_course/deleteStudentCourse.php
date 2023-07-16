<?php
    include("../config.php");
    $scid=$_GET['scid'];
    $sql="DELETE FROM student_course WHERE scID= $scid";
    $conn->query($sql);

    header("location:displayStudentCourse.php?id=<?=$scid?>");
?>