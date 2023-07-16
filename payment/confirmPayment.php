<?php
    $id=$_GET['id'];
    $amount=$_POST['paid'];

    $sql="INSERT INTO payment_record(scID,Paid) VALUES($id, $paid)";
    $conn->query($sql);

    header("location: displayPayment.php?id=<?=$id?>");

?>