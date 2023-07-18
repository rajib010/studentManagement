<?php
    include ("../config.php");
    include("../navbar.php");


    $sql="SELECT * FROM course_record
        ";
    $result=$conn->query($sql);

?>

<table border="1">
    <thead>
        <tr>
            <th>cID</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Action</th>
            <th>Syllabus</th>
        </tr>
    </thead>
<?php
    while($row=$result->fetch_assoc()){
?>
    <tr>
        <td><?= $row['cID'] ?></td>
        <td><?=$row['Title']?></td>
        <td><?=$row['Duration']?></td>
        <td><?=$row['Price']?></td>
        
        <td>
            <a href="updateCourse.php?id=<?= $row['cID']?>">Update</a>
            <a href="deleteCourse.php?id=<?= $row['cID']?>">Delete</a>
        </td>
        <td>
            <a href="./syllabus/addSyllabus.php?cid=<?= $row['cID']?>">Add</a>
            <a href="./syllabus/viewSyllabus.php?cid=<?= $row['cID']?>">View</a>
        </td>
       
    </tr>


<?php
    }
    ?>
</table>