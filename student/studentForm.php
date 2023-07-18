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
  <input type="radio" name="gender" value="Female"> <br> <br>
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
    $sql = "SELECT * from district";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
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
  </select> <br> <br>

  <!-- option to select the course previously studied by the student -->
  Stream <br>
  <select name="stream" id="stream" onchange="showCourse(this.value)">
    <option value="">--Select Stream--</option>
    <?php
    $sql1 = "SELECT * from stream";
    $result1 = $conn->query($sql1);
    while ($row1 = $result1->fetch_assoc()) {
    ?>
      <option value="<?= $row1['sID'] ?>"><?= $row1['Stream'] ?></option>
    <?php
    }
    ?>
  </select> <br> <br>

  Course <br>
  <select name="course" id="course">
    <option value="">--Select Course--</option>
  </select> <br> <br>

  <?php
  include "../config.php";
  $sql3 = "SELECT * FROM interested";
  $result3 = $conn->query($sql3);

  echo '<h2>Select your interested fields</h2>';
  while ($row3 = $result3->fetch_assoc()) {
  ?>
    <table border="1">

      <td>
        <input type="checkbox" name="interest[]" value="<?= $row3['id'] ?>"> <?= $row3['Field'] ?>
      </td>
    <?php
  }
    ?>
    </table>

    <button type="submit">Submit</button>

</form>

<script>
  function showCity(str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("city").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "../ajax/getcity.php?id=" + str, true);
    xmlhttp.send();

  }

  function showCourse(srt) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("course").innerHTML = this.responseText;
        console.log(this.responseText);
      }
    };
    xmlhttp.open("GET", "../ajax/getCourse.php?id=" + srt, true);
    xmlhttp.send();
  }
</script>