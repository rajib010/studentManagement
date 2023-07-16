<?php
    include("../config.php");
    $sql = "SELECT * FROM course_record";
    $result = $conn->query($sql);
    $id = $_GET['id'];

?>

<form action="confirmStdCourse.php" method="post">
<h1>Add course to students.</h1>
<p>Select course information: </p>
    <select name="course">
        <option>Select Option</option>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <option value="<?= $row['cID'] ?>"> <?= $row['Title'] ?> </option>

        <?php
        }
        ?>
    </select> <br>
    Advance Payment
        <input type="number" name="advPayment">
        <input type="hidden" name="student" value="<?=$_GET['id']?>">
        <button type="submit" name="add">Add</button>
</form>