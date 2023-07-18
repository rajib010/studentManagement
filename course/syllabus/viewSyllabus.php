<?php
include("../../config.php");
$cid = $_GET['cid'];
$sql = "SELECT * FROM syllabus 
        JOIN course_record ON course_record.cID= syllabus.courseID
        where syllabus.courseID=$cid";
$result = $conn->query($sql);
?>
<table border="1">
    <tr>
        <th>Sn.</th>
        <th>Course</th>
        <th>Syllabus</th>
    </tr>
    <tbody>
        <?php
        $i = 1;
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['Title'] ?></td>
            <td><?= $row['Syllabus'] ?></td>
            </tr>

        <?php
        }
        ?>
    </tbody>
</table>