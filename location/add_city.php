<?php
    include("../config.php");
?>

<form action="confirm_city.php" method="post">
    District: <br> 
   <select name="district" id="district">
    <option value="">--Select district--</option>
    <?php
$sql="SELECT * from district";
$result=$conn->query($sql);
while($row=$result->fetch_assoc()){
 ?>
 <option value="<?= $row['dID'] ?>"><?= $row['District'] ?></option>
 <?php
}

    ?>
   </select>
    City: <br> 
    <input type="text" name="city">
    
    <button type="submit">Add</button>
</form>

