<?php
    if(isset($_POST['submitBtn'])){
        include "../../config.php";
        $field= $_POST['interestedFields'];
        $sql="INSERT INTO interested(Field) VALUES('$field')";
        $conn->query($sql);      
    }
?>
<form action="" method="post">
    <h3>Enter the available interested Fields...</h3>
    <input type="text" name="interestedFields">
    <button type="submit" name="submitBtn">Add field</button>
</form>