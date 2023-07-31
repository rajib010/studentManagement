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

// for login
// if (isset($_POST['login'])) {
//     $query_login = "SELECT * FROM login WHERE uname = :uname OR email = :email";
//     $stmt1 = $pdo->prepare($query_login);
//     $stmt1->bindParam(':uname', $_POST['uname']);
//     $stmt1->bindParam(':email', $_POST['uname']);
//     $stmt1->execute();
//     if ($stmt1) {
//         if ($stmt1->rowCount() == 1) {
//             $result_fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC);
//             if ($result_fetch1['is_verified'] == 1) {


//                 if (password_verify($_POST['password'], $result_fetch1['password'])) {
//                     // if password matched
//                     $_SESSION['logedin'] = true;
//                     $_SESSION['name'] = $result_fetch1['uname'];
//                     if(isset($_POST['remember']))
//                     {
//                         setcookie('email', $_POST['uname'], time() + (60*60*24*30));
//                         setcookie('password', $_POST['password'], time() + (60*60*24*30));
//                     }
//                     else
//                     {
//                         setcookie('email', '', time() - (60*60*24*30));
//                         setcookie('password', '', time() - (60*60*24*30));
//                     }
//                     header('location:../home.php');

//                 } 
//                 else
//                 {
//                     echo "
//                 <script>
//                     alert('Incorrect password');
//                     window.location.href='login.php';
//                 </script>
//                 ";
//                     exit;
//                 }
//             } 
//             else 
//             {
//                 echo "
//             <script>
//                 alert('Email not verified');
//                 window.location.href='login.php';
//             </script>
//             ";
//             }
//         } else {
//             echo "
//             <script>
//                 alert('Email or Username not registered');
//                 window.location.href='login.php';
//             </script>
//             ";
//             exit;
//         }
//     } else {
//         echo "
//         <script>
//             alert('Cannot Run Query');
//             window.location.href='Login.php';
//         </script>
//         ";
//         exit;
//     }
// }


// // For registration
if (isset($_POST['register'])) {
    $user_existed_query = "SELECT * FROM login WHERE UserName = :username OR email = :email";
    $stmt = $pdo->prepare($user_existed_query);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();


    if ($stmt) {
        if ($stmt->rowCount() > 0) {
            $result_fetch = $stmt->fetch(PDO::FETCH_ASSOC); #it will be executed if username or email is already taken
            if ($result_fetch['UserName'] == $_POST['username']) {
                echo "
                <script>
                    alert('$result_fetch[UserName]-Username already taken');
                    window.location.href='registration.php';
                </script>
                ";
                exit;
            } else {
                echo "
                <script>
                    alert('$result_fetch[Email]-Email already taken');
                    window.location.href='registration.php';
                </script>
                ";
                exit;
            }
        } else {
            if ($_POST['password'] == $_POST['ConPassword']) {

                $uname=filteration($_POST['username']);
                $email=filteration($_POST['email']);
                $phone=filteration($_POST['phone']);
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $v_code = bin2hex(random_bytes(16));
                $a = 0;


                $query = "INSERT INTO login (UserName, Password, Phone, Email, ...............) VALUES (:name, :password, :phone, :email, :......................)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':username', $uname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':email_verification', $v_code);
                $stmt->bindParam(':is_verified', $a);
                if ($stmt->execute() && sendmail($_POST['email'], $v_code)) {
                    echo "
                    <script>

                        alert('Registration Successful');
                        window.location.href='login.php';
                    </script>
                    ";
                    exit;
                } else {
                    echo "
                    <script>
                        alert('RServer Down');
                        window.location.href='registration.php';
                    </script>
                    ";
                    exit;
                }
            } else {
                echo "
                <script>
                    alert('Password does not match');
                    window.location.href='registration.php';
                </script>
                ";
                exit;
            }
        }
    } else {
        echo "
        <script>
            alert('Cannot Run Query');
            window.location.href='registration.php';
        </script>
        ";
        exit;
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