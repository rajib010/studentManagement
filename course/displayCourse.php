<?php
include("../config.php");
include "../pages/navbar.php";
$sql = "SELECT * FROM course_record";

if (isset($_POST['filterBtn'])) {

    $orderBy = $_POST['orderBy'];
    $sql.=" ORDER BY $orderBy";
      
}
$result = $conn->query($sql);
?>

<div class="container">
    <!-- code for the order by option -->
    <span>
        <h5>Order by</h5>
    </span>
    <form action="" method="post">
        <select name="orderBy" id="">
            <option value="" selected>--Default--</option>
            <option value="Title">Name &uarr;</option>
            <option value="Duration">Duration &uarr;</option>
            <option value="Price">Price &uarr;</option>
        </select>
        <button name="filterBtn">Order</button>
    </form>
    <br> <br>


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
    while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?= $row['cID'] ?></td>
            <td><?= $row['Title'] ?></td>
            <td><?= $row['Duration'] ?></td>
            <td><?= $row['Price'] ?></td>

            <td>
                <a href="updateCourse.php?id=<?= $row['cID'] ?>">Update</a>
                <a href="deleteCourse.php?id=<?= $row['cID'] ?>">Delete</a>
            </td>
            <td>
                <a href="./syllabus/addSyllabus.php?cid=<?= $row['cID'] ?>">Add</a>
                <a href="./syllabus/viewSyllabus.php?cid=<?= $row['cID'] ?>">View</a>
            </td>

        </tr>


    <?php
    }
    ?>
</table>

</div>