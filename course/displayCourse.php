<?php
    include ("../config.php");
    include("../navbar.php");


    $sql="SELECT * FROM course_record";
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
       
    </tr>


<?php
    }
    ?>
</table>