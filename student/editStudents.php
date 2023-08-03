<?php
include("../config.php");
include("../pages/navbar.php");
$sid = $_GET['id'];
$sql = "SELECT * FROM student_record WHERE sID= $sid";
$result = $conn->query($sql);

if (isset($_POST['edit'])) {

    $name = filteration($_POST['sName']);
    $gender = filteration($_POST['gender']);
    $address = filteration($_POST['address']);
    $contact = $_POST['pNumber'];
    $email = filteration($_POST['email']);

    $sql = "UPDATE student_record SET Name='$name',Gender='$gender',Address='$address',Contact='$contact',Email='$email' WHERE sID=$sid";
    $conn->query($sql);

    header("location: displayStudent.php");
}

while ($row = $result->fetch_assoc()) {
?>
    <div class="container">

        <form action="" method="post">

            Name: <br>
            <input type="text" name="sName" value="<?= $row['Name'] ?>"> <br><br>
            Select your Gender: <br>
            Male
            <input type="radio" name="gender" value="Male" <?php if ($row['Gender'] == 'Male') {
                                                                echo 'checked';
                                                            } ?>>
            Female
            <input type="radio" name="gender" value="Female" <?php if ($row['Gender'] == 'Female') {
                                                                    echo 'checked';
                                                                } ?>> <br>

            Enter your address: <br>
            <input type="text" name="address" value="<?= $row['Address'] ?>"> <br> <br>
            Enter your phone number: <br>
            <input type="text" name="pNumber" value="<?= $row['Contact'] ?>"> <br><br>
            Enter your email: <br>
            <input type="email" name="email" value="<?= $row['Email'] ?>"> <br> <br>
            <button type="submit" name="edit">Edit</button>
        <?php
    }
        ?>
        </form>

    </div>