<?php
    include ("../config.php");
    $district=filteration($_POST['district']);
    $city=filteration($_POST['city']);
 
    $sql= "INSERT INTO City(dID, City) VALUES('$district', '$city')";
    $conn->query($sql);

    header('location:add_city.php');
?>