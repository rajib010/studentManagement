<?php
include "../config.php";
include "../pages/navbar.php";
$sql = "SELECT * FROM student_record";

if (isset($_POST['searchBtn'])) {
    $search_param = $_POST['search'];
    $sql .= " WHERE Name LIKE '%$search_param%'";
    echo "done";
}
$result = $conn->query($sql);
?>
<div class="container">
    <br>
    <span>
        <h5>Search For:</h5>
    </span>

    <form action="" method="post">
        <input type="search" name="search" placeholder="Search for">
        <button type="submit" name="searchBtn">Search</button>
    </form>
    <br> <br>
    <table border="1" class="table table-hover">
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
        if (!$result) {
            // $row = $result->fetch_assoc();
            echo "<h3>No such user found </h3>";
          ?>
           
        <?php
        }
    
        else {
        
            echo "<h3> user found </h3>";         
            while ($row = $result->fetch_assoc()) {
                ?>
                 <tr>
                <td><?= $row['sID'] ?></td>
                <td> <?= $row['Name'] ?> </td>
                <td><?= $row['Gender'] ?> </td>
                <td><?= $row['Address'] ?> </td>
                <td> <?= $row['Contact'] ?> </td>
                <td> <?= $row['Email'] ?> </td>
                <td>
                    <a href="../student_course/stdCourseForm.php?id=<?= $row['sID'] ?>">Add </a>
                    <a href="../student_course/displayStudentCourse.php?id=<?= $row['sID'] ?>">View </a>
                </td>
                <td>
                    <a href="editStudents.php?id=<?= $row['sID'] ?>">Edit</a>
                    <a onclick="return confirm('Are you sure to delete it?')" href="deleteStudents.php?id=<?= $row['sID'] ?>">Delete</a>
                </td>
            </tr>
            
       <?php
        }
    }
        ?>
    </table>
</div>
