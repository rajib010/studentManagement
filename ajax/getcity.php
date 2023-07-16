<?php
 include("../config.php");

$id=$_GET['id'];
$sql="SELECT * from city where dID=$id ";
$result=$conn->query($sql);
?>
 <option value="">--Select city--</option>
<?php
while($row=$result->fetch_assoc())
{

?>

<option value="<?=$row['cID'] ?>"><?=$row['City'] ?></option>

<?php
}
echo "$id";
?>