<?php
include("../config.php");
$id = $_GET['id'];

$sql = "SELECT * FROM course_record where streamID=$id";
$result = $conn->query($sql);
?>

<option value="">--Select Course--</option>
<?php
while ($row = $result->fetch_assoc()) {

?>
    <option value="<?= $row['cID'] ?>"><?= $row['Title'] ?></option>

<?php
}
echo "$id"; 
?>