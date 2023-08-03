<?php
require_once "../backend/dbcontroller.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($email, $v_code)
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
        $mail->Username = 'pokhrelrajib@gmail.com'; //SMTP username
        $mail->Password = 'sowkeubflvfcocmr'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sanjelsarbada12@gmail.com', 'Sarbada Sanjel');
        $mail->addAddress($email); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Email Verification from Sarbada Sanjel';
        $mail->Body = "Thanks for Verification! <br>
        Click the link below to verify the email address
        <a href='http://localhost/bcaNepal/verify.php?email=$email&v_code=$v_code'>Verify Email</a>";


        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }

}

// for login
if (isset($_POST['login'])) {
    $query_login = "SELECT * FROM login WHERE uname = :uname OR email = :email";
    $stmt1 = $pdo->prepare($query_login);
    $stmt1->bindParam(':uname', $_POST['uname']);
    $stmt1->bindParam(':email', $_POST['uname']);
    $stmt1->execute();
    if ($stmt1) {
        if ($stmt1->rowCount() == 1) {
            $result_fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC);
            if ($result_fetch1['is_verified'] == 1) {


                if (password_verify($_POST['password'], $result_fetch1['password'])) {
                    // if password matched
                    $_SESSION['logedin'] = true;
                    $_SESSION['name'] = $result_fetch1['uname'];
                    if(isset($_POST['remember']))
                    {
                        setcookie('email', $_POST['uname'], time() + (60*60*24*30));
                        setcookie('password', $_POST['password'], time() + (60*60*24*30));
                    }
                    else
                    {
                        setcookie('email', '', time() - (60*60*24*30));
                        setcookie('password', '', time() - (60*60*24*30));
                    }
                    header('location:../home.php');
                    
                } 
                else
                {
                    echo "
                <script>
                    alert('Incorrect password');
                    window.location.href='login.php';
                </script>
                ";
                    exit;
                }
            } 
            else 
            {
                echo "
            <script>
                alert('Email not verified');
                window.location.href='login.php';
            </script>
            ";
            }
        } else {
            echo "
            <script>
                alert('Email or Username not registered');
                window.location.href='login.php';
            </script>
            ";
            exit;
        }
    } else {
        echo "
        <script>
            alert('Cannot Run Query');
            window.location.href='Login.php';
        </script>
        ";
        exit;
    }
}


