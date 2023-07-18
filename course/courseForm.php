<?php
include("../navbar.php");
include("../config.php");
?>

<form action="confirmCourse.php" method="post">
    Stream <br>
    <select name="stream">
        <option value="">--Select Stream--</option>
        <?php
        $sql = "SELECT * from stream";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
            <option value="<?= $row['sID'] ?>"><?= $row['Stream'] ?></option>
        <?php
        }
        ?>
    </select>
    Course Title: <br>
    <input type="text" name="CourseTitle"> <br> <br>
    Duration: <br>
    <input type="text" name="CourseDuration"> <br> <br>
    Course Price: <br>
    <input type="text" name="CoursePrice"> <br> <br>

    <button type="submit">Submit</button>

</form>