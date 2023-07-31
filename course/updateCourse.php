<?php
include("../config.php");
include("../pages/navbar.php");
$id = $_GET['id'];
$sql = "SELECT * FROM course_record WHERE cID=$id";
$result = $conn->query($sql);

if (isset($_POST['updateBtn'])) {

    $title=$_POST['CourseTitle'];
    $duration=$_POST['CourseDuration'];
    $price=$_POST['CoursePrice'];

    $sql="UPDATE course_record SET Title='$title',Duration='$duration',Price='$price' WHERE cID=$id";
    $conn->query($sql);

    header("location:displayCourse.php");
}

while ($row = $result->fetch_assoc()) {
?>
    <form action="updateCourse.php?id=<?= $id ?>" method="post">

        Course Title: <br>
        <input type="text" name="CourseTitle" value="<?= $row['Title']?>"> <br> <br>
        Duration: <br>
        <input type="text" name="CourseDuration" value="<?= $row['Duration']?>"> <br> <br>
        Course Price: <br>
        <input type="text" name="CoursePrice" value="<?= $row['Price']?>"> <br> <br>

        <button type="submit" name="updateBtn">Update</button>



    <?php
}
    ?>
    </form>