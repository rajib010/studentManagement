<?php
    include("../config.php");
?>
<form action="confirmStudent.php" method="post">
    Name: <br> 
    <input type="text" name="sName"> <br><br>
    Select your Gender: <br>
    Male
    <input type="radio" name="gender" value="Male">
    Female
    <input type="radio" name="gender" value="Female"> <br>  <br>
    Enter your address: <br>
    <input type="text" name="address"> <br> <br>
    Enter your phone number: <br>
    <input type="text" name="pNumber"> <br><br>
    Enter your email: <br>
    <input type="email" name="email"> <br> <br>
    District: <br> 
   <select name="district" id="district" onchange="showCity(this.value)">
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
   <br>
    City: <br> 
    
   <select name="city" id="city">
    <option value="">--Select city--</option>
    <button type="submit">Submit</button>
</form>

<script>
function showCity(str) {
 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("city").innerHTML = this.responseText;
        console.log(this.responseText);
      }
    };
    xmlhttp.open("GET", "../ajax/getcity.php?id=" + str, true);
    xmlhttp.send();
 
}
</script>