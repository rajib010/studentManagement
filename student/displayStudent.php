<?php
include("../config.php");
include("../navbar.php");
$sql = "SELECT * FROM student_record";
$result = $conn->query($sql);

?>
<table border="1">
    <thead>
        
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Phone No</th>
            <th>Email</th>
            <th>Course</th>
            <th>Action</th>
        </tr>
    </thead>

        <?php
           while ($row = $result->fetch_assoc()) {
        ?>

            <tr>
                <td><?= $row ['sID']?></td>
                <td> <?= $row['Name'] ?> </td>
                <td><?= $row['Gender'] ?> </td>
                <td><?= $row['Address'] ?> </td>
                <td> <?= $row['Contact'] ?> </td>
                <td> <?= $row['Email'] ?> </td>
                <td> 
                    <a href="../student_course/stdCourseForm.php?id=<?= $row['sID']?>">Add </a> 
                    <a href="../student_course/displayStudentCourse.php?id=<?= $row['sID']?>">View </a> 
                </td>
                <td>
                    <a href="editStudents.php?id=<?= $row['sID'] ?>">Edit</a>
                    <a onclick="return confirm('Are you sure to delete it?')" href="deleteStudents.php?id=<?= $row['sID'] ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
</table>