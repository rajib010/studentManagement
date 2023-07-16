<?php
include("../config.php");
$id = $_GET['id'];


if (isset($_POST['YesBtn'])) {
    $id=$_GET['id'];
    $sql = "DELETE FROM course_record WHERE cID=$id";
    $conn->query($sql);
    header("location:displayCourse.php");
}
?>

<h1>Are you sure?</h1>

<form action="deleteCourse.php?id=<?= $id ?>" method="post">

    <button type="submit" name="YesBtn">Yes</button>
    <button type="submit" name="NoBtn">No</button>

</form>