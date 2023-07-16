<?php
    include ("../config.php");
    $district=$_POST['district'];
    $city=$_POST['city'];
 
    $sql= "INSERT INTO City(dID, City) VALUES('$district', '$city')";
    $conn->query($sql);

    header('location:add_city.php');
?>