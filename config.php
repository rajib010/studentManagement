<?php
    $host='localhost';
    $username='root';
    $password='';
    $db_name='studentmanagement';
    $conn= mysqli_connect($host,$username,$password,$db_name);

?>
<?php
    $pdo= new PDO('mysql:host=localhost;dbname=studentmanagement','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>

