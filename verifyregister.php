<?php
require('config.php');


if(isset($_GET['email']) && isset($_GET['v_code']))
{
$query="SELECT * FROM login where Email=:email and Email_Verfication=:email_verification";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $_GET['email']);
$stmt->bindParam(':email_verification',$_GET['v_code']);
$stmt->execute();
if($stmt)
{
    if ($stmt->rowCount() == 1)
    {
        $result_fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result_fetch['isVerified'] == 0)
        {
            $update = $pdo->prepare("UPDATE login SET isVerified=:is_verified WHERE Email=:email");
            $verify=1;
            $update->bindParam(':is_verified', $verify);   
            $update->bindParam(':email', $result_fetch['Email']);
            $update->execute();
            if($update)
            {
                echo "
                <script>
            
                    alert('Email Verification Successfull');
                    window.location.href='index.php';
                </script>
                ";
            }
            else
            {
                echo "
                <script>
            
                    alert('Cannot run query');
                    window.location.href='register.php';
                </script>
                ";
            }
        }
        else
        {
            echo "
            <script>
        
                alert('Email already verified');
                window.location.href='index.php';
            </script>
            ";
        }
        }
    }
}
else
{
    echo "
    <script>

        alert('Cannot run query');
        window.location.href='register.php';
    </script>
    ";
}
?>