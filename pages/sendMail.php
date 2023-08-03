<?php

require_once "../config.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submitBtn'])) {
    // echo $_POST['email'] . '<br>';
     $email=$_POST['email'];
     $message=$_POST['message'];
     $subject=$_POST['subject'];
   

    

     // Include the PHPMailer library.
     require '../PHPMailer/src/PHPMailer.php';
     require '../PHPMailer/src/SMTP.php';
     require '../PHPMailer/src/Exception.php';
     
     // Create a new instance of the PHPMailer class.
     $mail = new PHPMailer();
     
     // Set the SMTP server, port, and authentication credentials.
     $mail->SMTPDebug = 0; // Enable debugging
     $mail->isSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'pokhrelrajib016@gmail.com';
     $mail->Password = 'avsptfzlrsoybozv';
     $mail->SMTPSecure = 'ssl';
     $mail->Port = 465;
     
     // Set the sender's email address and name.
     $mail->From = 'pokhrelrajib016@gmail.com';
     $mail->FromName = 'Rajib';
     
     // Add the recipient's email address.
     $mail->addAddress($email);
     
     // Set the subject and body of the email.
     $mail->Subject = $subject;
     $mail->Body = $message;
     
     // If you are sending an HTML email, set the `isHTML()` property to `true`.
     $mail->isHTML(true);
     
     // If you are adding attachments, do so now.
     // $mail->addAttachment('file.pdf');
     
     // Finally, call the `send()` method to send the email.
     if ($mail->send()) {
         echo 'Email sent successfully!';
     } else {
         echo 'Email not sent!' . $mail->ErrorInfo;
     }
     
     
}
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>contact form</title>
    <link href="../css/emailform.css" rel="stylesheet">
</head>

<body>


    <div class="fcf-body">

        <div id="fcf-form">
            <h3 class="fcf-h3">Contact us</h3>

            <form id="fcf-form-id" class="fcf-form-class" method="post" action="">

                <div class="fcf-form-group">
                    <label for="Name" class="fcf-label">Your name</label>
                    <div class="fcf-input-group">
                        <input type="text" id="Name" name="name" class="fcf-form-control" required>
                    </div>
                </div>

                <div class="fcf-form-group">
                    <label for="Email" class="fcf-label">Send Email To: </label>
                    <div class="fcf-input-group">
                        <input type="email" id="Email" name="email" class="fcf-form-control" required>
                    </div>
                </div>

                <div class="fcf-form-group">
                    <label for="subject" class="fcf-label">Email Subject: </label>
                    <div class="fcf-input-group">
                        <input type="text" id="subject" name="subject" class="fcf-form-control" required>
                    </div>
                </div>

                <div class="fcf-form-group">
                    <label for="Message" class="fcf-label">Your message</label>
                    <div class="fcf-input-group">
                        <textarea id="Message" name="message" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
                    </div>
                </div>

                <div class="fcf-form-group">
                    <button type="submit" id="fcf-button" name="submitBtn" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Send Message</button>
                </div>

            </form>
        </div>

    </div>

</body>

</html>