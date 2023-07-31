<?php
include "../config.php";
include "navbar.php";
if (!($_SESSION['userName'] && $_SESSION['passWord'])) {
    header('location: index.php');
} else if ($_SESSION['userName'] && $_SESSION['passWord']) {
    //display screen for the superuser....
    if($_SESSION['userLevel']==1){
        echo "<h1> this is superuser";
?>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="">

<div class="flex-wrap">
    <div class="bg-dark">
        <a href="" class="d-flex text-decoration-none align-items-center">
            <i class="fs-5 fa fa-guage"></i>
        </a>
    </div>
</div>



<script src="../bootstrap/js/bootstrap.bundle.js"></script>
<?php

    }//display screen for the other user....
    else if($_SESSION['userLevel']==0){
        echo "<img src='../images/user-home.avif'height='auto' width='1500px' class='img-fluid'>";

    }
}
?>


