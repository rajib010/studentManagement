<?php
    include ("../config.php");
    $district=$_POST['district'];
 
    $sql= "INSERT INTO district(district) VALUES('$district')";
    $conn->query($sql);

    header('location:add_district.php');
?>