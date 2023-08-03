<?php
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
// z            if ($result_fetch1['is_verified'] == 1) {


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

