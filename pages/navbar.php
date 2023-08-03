<?php
include "../config.php";
include "../functions.php";

session_start();
if (empty($_SESSION['userName'])) {
    header('location: ../index.php');
} else if ($_SESSION['userName'] && ($_SESSION['passWord'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Management</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        
    </head>

    <body>
        <?php
        // for admin level
        if ($_SESSION['userName'] && $_SESSION['passWord'] && $_SESSION['userLevel'] == 1) {
        ?>
            <nav class="navbar navbar-expand-lg bg-light success">
                <div class="container-fluid">
                    <a class="navbar-brand" href="">Student Management</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../pages/dashboard.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../student/displayStudent.php">Student List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../course/displayCourse.php">Course List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./changePassword.php">Change Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../logout.php">Log out</a>
                            </li>



                        </ul>
                        <form class="d-flex" action="" method="post" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" name="searchInput" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- end of navbar code for admin  -->


        <?php
            //
        } //for other users
        else if ($_SESSION['userName'] && $_SESSION['passWord'] && ($_SESSION['userLevel'] == 0)) {
        ?>
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="">Welcome User</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../pages/dashboard.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./aboutus.php">About us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./contactus.php">Contact us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./changePassword.php">Change Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../logout.php">Log out</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        <?php
        }

        ?>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

    </body>

    </html>
<?php
}
?>