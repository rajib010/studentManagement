<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <img src="./assets/images/logo.png" width="120" height="120" alt="Swiss Collection">
        <h5 style="margin-top:10px;">Hello, Admin</h5>
    </div>

    <hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="./index.php"><i class="fa fa-home"></i> Dashboard</a>
    <a href="../student/displayStudent.php" onclick="showCustomers()"><i class="fa fa-users"></i> Students</a>
    <a href="../stream/addStream.php" onclick="showCategory()"><i class="fa fa-th-large"></i> Streams</a>
    <a href="../location/add_city.php" onclick="showSizes()"><i class="fa fa-th"></i> City</a>
    <a href="../payment/addPayment.php" onclick="showProductSizes()"><i class="fa fa-th-list"></i> Payment</a>
    <a href="../course/displayCourse.php" onclick="showProductItems()"><i class="fa fa-th"></i> Courses</a>
    <a href="../student/studentForm.php" onclick="showProductItems()"><i class="fa fa-th"></i> Add Student</a>

    <!-- Available -->
</div>

<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>