<?php
    include("../config.php");
    $id = $_GET['id'];
    $sql="SELECT * from payment_record 
          join student_course on student_course.scID= payment_record.scID
          join course_record on course_record.cID=student_course.cID
          join student_record on student_record.sID=student_course.sID where student_course.sID=$id ";
          $result= $conn->query($sql);

?>
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Course</th>
            <th>Paid</th>
            <th>Remaining</th>
        </tr>
    </thead>
<?php
    while($row=$result->fetch_assoc()){
?>

<?php

?>
    <tr>
        <td><?= $row['Name'] ?></td>
        <td><?= $row['Title'] ?></td>
        <td><?= $row['Paid'] ?></td>
        <td><?= $row['Remaining'] ?></td>
    </tr>



<?php
    }

?>
</table>