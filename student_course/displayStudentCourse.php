<?php
include("../config.php");
include("../navbar.php");

$id = $_GET['id'];

$sql = "SELECT * FROM student_course 
join course_record on course_record.cID = student_course.cID
join student_record on student_record.sID =  student_course.sID 
WHERE student_course.sID = $id";


$result = $conn->query($sql);
?>
<table border="1">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Payment</th>
            <th>Action</th>
        </tr>
    </thead>

    <?php
    while ($row = $result->fetch_assoc()) {
    ?>

        <tr>
            <td> <?= $id ?></td>
            <td> <?= $row['Name'] ?> </td>
            <td> <?= $row['Title'] ?> </td>
            <td>
                <a href="../payment/addPayment.php?id=<?=$id?>">ADD</a>
                <a href="../payment/displayPayment.php?id=<?=$id?>">VIEW</a>
            </td>
            <td>
                <a href="editStudentCourse.php?scid=<?= $row['scID']?> &sid=<?=$id ?>">EDIT</a>
                <a href="deleteStudentCourse.php?scid=<?= $row['scID']?> &sid=<?=$id ?>">DELETE</a>

            </td>
        </tr>
    <?php
    }
    ?>
</table>