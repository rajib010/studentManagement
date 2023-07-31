<?php
include "../config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
{
    require('../PHPMailer/src/PHPMailer.php');
    require('../PHPMailer/src/Exception.php');
    require('../PHPMailer/src/SMTP.php');

    $mail = new PHPMailer();
    try {
        $mail->isSMTP(); //method using
        $mail->Host = 'smtp.gmail.com'; //setting up the server
        $mail->SMTPAuth = true; //enabling the authentication
        $mail->Username = 'pokhrelrajib016@gmail.com';
        $mail->Password = 'avsptfzlrsoybozv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //implicit tls encryption
        $mail->Port = 465; //tcp port to connect to;

        //Sender
        $mail->setFrom('pokhrelrajib016@gmail.com', 'Rajib Pokhrel');
        //add a recipient 
        $mail->addAddress($email); 


        //contents
        $mail->isHTML(true); // email format is html
        $mail->Subject = 'Password reset link';
        $mail->Body = "To reset your password , click on the link below: 
            <a href='http://localhost/studentManagement/forgotpassword/updatepassword.php?email=$email&rest_token=$reset_token'>Reset Password</a>";

        $mail->send();
        return true;
    } catch (Exception $e){
        return false;
    }
}



    if (isset($_POST['submitBtn'])) {
    $query = "SELECT * FROM login where Email=:email";
    $stmt1 = $pdo->prepare($query);
    $stmt1->bindParam(':email', $_POST['rst-email']);
    $stmt1->execute();
    if ($stmt1) {
        if ($stmt1->rowCount() == 1) {
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/Kathmandu');
            $date = date("Y-m-d");
            $query5 = $pdo->prepare("UPDATE login set resettoken=:resettoken,   tokenexpired=:tokenexpired where Email=:email");
            $query5->bindParam(':resettoken', $reset_token);
            $query5->bindParam(':tokenexpired', $date);
            $query5->bindParam(':email', $_POST['rst-email']);
            $query5->execute();
            if ($query5 && sendMail($_POST['rst-email'], $reset_token)) {
                echo "
                <script>
                    alert('Password reset link sent to mail ');
                    window.location.href='../index.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Server Down');
                    window.location.href='../login.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Email not found');
                window.location.href='./sendEmail.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Cannot run query');
            window.location.href='../index.php';
        </script>
        ";
    }
}

?>