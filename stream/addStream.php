<?php
    include("../navbar.php");
?>

<form action="addStream.php" method="post">
    Stream<br>
    <input type="text" name="stream"> <br> <br>
    <button type="submit" name="submitBtn">Submit</button>
</form>

<?php
    if(isset($_POST['submitBtn'])){
        include("../config.php");
        $stream=$_POST['stream'];
        $sql="INSERT INTO stream(Stream) Values('$stream')";
        $conn->query($sql);
    }
?>