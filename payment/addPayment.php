<?php
include("../config.php");
$id = $_GET['id'];
$sql = "SELECT * FROM payment_record 
          join student_course on student_course.scID= payment_record.scID 
          join student_record on student_record.sID = student_course.sID 
          join course_record on course_record.cID= student_course.cID
          where student_record.sID=$id";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

?>
    <form action="confirmPayment.php?id=<?= $id ?>" method="post">
    <h3>The remaining amount of the subject <?= $row['Title'] ?> </h3>
    Remaining: <br>
        <input type="number" name="remaining"> <br><br>
        Paid:
        <input type="number" name="paid" value="<?= $row['Paid']?>"> <br>

        <button type="submit" name="payBtn">Pay Amount</button> <br>


    <?php
}
    ?>
    </form>