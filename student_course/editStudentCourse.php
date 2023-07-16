<?php
include("../config.php");

$scid = $_GET['scid'];
$sid = $_GET['sid'];

$sql1 = "SELECT * FROM student_course WHERE scID='$scid'";
$sql = "SELECT * FROM course_record";
$result = $conn->query($sql);
$result1 = $conn->query($sql1);
// print_r($result);
// die();

if (isset($_POST['editBtn'])) {
    // $id = $_GET['id'];
    $scid = $_POST['student'];

   // $sid = $_GET['sid'];
    $cid = $_POST['course'];
    $payment = $_POST['advPayment'];
    $sql = "UPDATE student_course SET cID=$cid, Amount=$payment WHERE scID=$scid";
    $var = $conn->query($sql);
    header("location:displayStudentCourse.php?id=$sid");
}

while ($row1 = $result1->fetch_assoc()) {

?>

    <form action="editStudentCourse.php?id=<?= $scid ?>" method="post">
        <h1>Add course to students.</h1>
        <p>Select course information: </p>
        <select name="course">
            <option>Select Option</option>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <option value="<?= $row['cID'] ?>" <?php
                                                    if ($row1['cID'] == $row['cID']) {
                                                        echo "selected";
                                                    }

                                                    ?>> <?= $row['Title'] ?> </option>

            <?php
            }
            ?>
        </select> <br>
        Advance Payment
        <input type="number" name="advPayment" value="<?= $row1['Amount'] ?>">
        <input type="hidden" name="student" value="<?= $_GET['scid'] ?>">
        <button type="submit" name="editBtn">Edit</button>

    </form>
<?php
}
?>