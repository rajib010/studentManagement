<?php
require("../dbcontroller.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
{
    require('../PHPMailer/PHPMailer.php');
    require('../PHPMailer/Exception.php');
    require('../PHPMailer/SMTP.php');

    $mail = new PHPMailer();
    try {
        //Server settings                      
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'sanjelsarbada12@gmail.com'; //SMTP username
        $mail->Password = 'sowkeubflvfcocmr'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sanjelsarbada12@gmail.com', 'Sarbada Sanjel');
        $mail->addAddress($email); //Add a recipient



        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Password Reset Link from Sarbada Sanjel';
        $mail->Body = "We got a request from you to reset your password! <br>
        Click the link below 
        <a href='http://localhost/bcaNepal/updatepassword.php?email=$email&rest_token=$reset_token'>Reset Password</a>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['send-reset-link'])) {
    $query = "SELECT * FROM login where email=:email";
    $stmt1 = $pdo->prepare($query);
    $stmt1->bindParam(':email', $_POST['email']);
    $stmt1->execute();
    if ($stmt1) {
        if ($stmt1->rowCount() == 1) {
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Kathmandu');
            $date = date("Y-m-d");
            $query5 = $pdo->prepare("UPDATE login set resettoken=:resettoken, tokenexpired=:tokenexpired where email=:email");
            $query5->bindParam(':resettoken', $reset_token);
            $query5->bindParam(':tokenexpired', $date);
            $query5->bindParam(':email', $_POST['email']);
            $query5->execute();
            if ($query5 && sendMail($_POST['email'], $reset_token)) {
                echo "
                <script>
                    alert('Password reset link sent to mail ');
                    window.location.href='forgot.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Server Down');
                    window.location.href='Login.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Email not found');
                window.location.href='forgot.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Cannot run query');
            window.location.href='Login.php';
        </script>
        ";
    }
}

?>





<!-- code 2 -->


<?php
require('dbcontroller.php');
if (isset($_GET['email']) && isset($_GET['rest_token'])) {
    date_default_timezone_set('Asia/Kathmandu');
    $date = date("Y-m-d");
    $query = "SELECT * FROM login where email=:email and resettoken=:resettoken";
    $stmt1 = $pdo->prepare($query);
    $stmt1->bindParam(':email', $_GET['email']);
    $stmt1->bindParam(':resettoken', $_GET['rest_token']);
    $stmt1->execute();
?>
    <!DOCTYPE html>
    <html lang="en">


    <!-- auth-reset-password.html  21 Nov 2019 04:05:02 GMT -->

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Password Update</title>
        <!-- General CSS Files -->
        <link rel="stylesheet" href="backend/assets/css/app.min.css">
        <!-- Template CSS -->
        <link rel="stylesheet" href="backend/assets/css/style.css">
        <link rel="stylesheet" href="backend/assets/css/components.css">
        <!-- Custom style CSS -->
        <link rel="stylesheet" href="backend/assets/css/custom.css">
        <link rel='shortcut icon' type='image/x-icon' href='backend/assets/img/favicon.ico' />
        <style>
            .password-wrapper {
                position: relative;
            }

            .toggle-password,
            .toggle-password1 {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
            }
        </style>
    </head>

    <body>

        <div class="loader"></div>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row-update">
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>Reset Password</h4>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">Enter Your New Password</p>


                                <?php
                                if ($stmt1) {
                                    if ($stmt1->rowCount() == 1) {
                                        echo
                                        "
                    <form method='POST'>
                   
                    <div class='form-group'>
                      <label for='password'>New Password</label>
                      <div class='password-wrapper'>
                      <input id='password' type='password' class='form-control pwstrength' data-indicator='pwindicator'
                        name='password' tabindex='2' required>
                        <span class='toggle-password' onclick='togglePasswordVisibility()'>
                        <i class='fa fa-eye'></i>
                    </span>
                    </div>
                      <div id='pwindicator' class='pwindicator'>
                        <div class='bar'></div>
                        <div class='label'></div>
                      </div>
                    </div>
                    <div class='form-group'>
                    <button type='submit' name='update-password' class='btn btn-primary btn-lg btn-block' tabindex='4'>
                    Reset Password
                    </button>
                    </div>
                    <input type='hidden' name='email' value='$_GET[email]'>
                  </form>
                    ";
                                    } else {
                                        echo "
                <script>
                    alert('Invalid or Expired Link');
                    window.location.href='pages/login.php';
                </script>
                ";
                                    }
                                } else {
                                    echo "
            <script>
                alert('Server Down ! Try again later');
                window.location.href='pages/login.php';
            </script>
            ";
                                }
                            }

                                ?>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['update-password'])) {
                    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

                    $update = $pdo->prepare("UPDATE login SET password=:password, resettoken=:resettoken, tokenexpired=:tokenexpired WHERE email=:email");

                    $update->bindParam(':password', $pass);
                    $update->bindValue(':resettoken', NULL, PDO::PARAM_NULL);
                    $update->bindValue(':tokenexpired', NULL, PDO::PARAM_NULL);
                    $update->bindParam(':email', $_POST['email']);
                    $update->execute();

                    if ($update) {
                        echo "
                    <script>
                        alert('Password updated successfully');
                        window.location.href='pages/login.php';
                    </script>
                    ";
                    } else {
                        echo "
                        <script>
                            alert('Server Down ! Try again later');
                            window.location.href='updatepassword.php';
                        </script>
                        ";
                    }
                }

                ?>

                <!-- General JS Scripts -->
                <script src="backend/assets/js/app.min.js"></script>
                <!-- JS Libraies -->
                <!-- Page Specific JS File -->
                <!-- Template JS File -->
                <script src="backend/assets/js/scripts.js"></script>
                <!-- Custom JS File -->
                <script src="backend/assets/js/custom.js"></script>
                <script>
                    function togglePasswordVisibility(){
                        var passwordInput = document.getElementById("password");
                        var toggleButton = document.querySelector(".toggle-password");
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            toggleButton.innerHTML = '<i class="fa fa-eye-slash"></i>';
                        } else {
                            passwordInput.type = "password";
                            toggleButton.innerHTML = '<i class="fa fa-eye"></i>';
                        }
                    }
                </script>
    </body>



    </html>