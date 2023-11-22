<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer/src/Exception.php';
require '../PHPMailer/PHPMailer/src/PHPMailer.php';
require '../PHPMailer/PHPMailer/src/SMTP.php';
$verification_code=substr(number_format(time()*rand(),0,'','',),0,6);
session_start();
if(isset($_POST["send"])){
    $cname=$_POST['cname'];
    $cno=$_POST['cno'];
    $exmon=$_POST['exmon'];
    $exyear=$_POST['exyear'];
    $cvv=$_POST['cvv'];
    $amount=$_POST['amount'];
    $mail=$_POST['mail'];
    
    

    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'onetamilgaming@gmail.com'; 
    $mail->Password   = 'npoz oxrd fuio xjhd';
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465; 

    //Recipients
    $mail->setFrom('onetamilgaming@gmail.com');
    $mail->addAddress($_POST["mail"]);     //Add a recipient
    
    $mail->isHTML(true);      
    // $verification_code=substr(number_format(time()*rand(),0,'','',),0,6);                          //Set email format to HTML
    $mail->Subject = 'verification code from citypass';
    $mail->Body    = '<p>your verification code is :<b> '.$verification_code.'</b></p>';
    $mail->send();

    //database
    include 'database.php';
    $sql="INSERT INTO `payment`( `name`, `creditno`, `expmon`, `expyear`, `cvv`, `amount`, `otp`, `cusId`, `currentdate`, `status`)
     VALUES ('".$cname."','".$cno."','".$exmon."','".$exyear."','".$cvv."','".$amount."','".$verification_code."',NULL,Now(),'pending...')";
    mysqli_query($con,$sql);
    echo"
    <script>
    document.location.href='../template/payment.php';
    </script>";

    $_SESSION['veotp']=$verification_code;
    echo $_SESSION['veotp'];
    


}
?>