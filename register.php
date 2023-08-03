<link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
<div class="container">
    <br> <br>

<form action="" class="form-control" method="post">
    <label for="username" id="username">Username</label>
    <input type="text" name="username" id="username"> <br> <br>

    <label for="password" id="password">Password</label>
    <input type="password" name="password" id="password"> <br> <br>

    <label for="Conpassword" id="Conpassword">Confirm Password</label>
    <input type="password" name="ConPassword" id="Conpassword"> <br> <br>

    <label for="email" id="email">Email</label>
    <input type="email" name="email" id="email"> <br> <br>

    <label for="phone" id="phone">Phone Number</label>
    <input type="phone" name="phone" id="phone"> <br> <br>

    <button type="submit" name="register">Register</button>
</form>
</div>


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendmail($email, $v_code)
{
    require('PHPMailer/src/PHPMailer.php');
    require('PHPMailer/src/Exception.php');
    require('PHPMailer/src/SMTP.php');

    $mail = new PHPMailer();
    try {
        //Server settings                      
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'pokhrelrajib016@gmail.com'; //SMTP username
        $mail->Password = 'avsptfzlrsoybozv'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('pokhrelrajib016@gmail.com', 'Rajib');
        $mail->addAddress($email); //Add a recipient

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Email Verification from Rajib';
        $mail->Body = "Thanks for Verification! <br>
        Click the link below to verify the email address
        <a href='verifyregister.php?email=$email&v_code=$v_code'>Verify Email</a>";


        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }

}
?>


<?php
include "config.php";

// For registration
if (isset($_POST['register'])) {
    $user_existed_query = "SELECT * FROM login WHERE UserName = :uname OR Email = :email";
    $stmt = $pdo->prepare($user_existed_query);
    $stmt->bindParam(':uname', filteration($_POST['username']));
    $stmt->bindParam(':email', filteration($_POST['email']));
    $stmt->execute();

    if ($stmt) {
        if ($stmt->rowCount() > 0) {
            $result_fetch = $stmt->fetch(PDO::FETCH_ASSOC); #it will be executed if username or email is already taken
            if ($result_fetch['UserName'] == (filteration($_POST['username']))) {
                echo "
                <script>
                    alert('$result_fetch[UserName]-Username already taken');
                    window.location.href='register.php';
                </script>
                ";
                exit;
            } else {
                echo "
                <script>
                    alert('$result_fetch[Email]-Email already taken');
                    window.location.href='register.php';
                </script>
                ";
                exit;
            }
        } else {
            if ($_POST['password'] == $_POST['ConPassword']) {

                $uname=($_POST['username']);
                $email=($_POST['email']);
                $email=($_POST['phone']);
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $v_code = bin2hex(random_bytes(16));
                $a = 0;

                $query = "INSERT INTO login (UserName, Password, Phone, Email, isVerified,Email_Verification) VALUES (:uname, :password,:phone, :email, :is_verified,:email_verification)";
                $stmt = $pdo->prepare($query);

                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':uname', $uname);
                
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