<?php
    include("../config.php");
    $id=$_GET['id'];
    $sql="DELETE FROM student_record where sID=$id";
    $conn->query($sql);
    header("location: displayStudent.php");
    
?>