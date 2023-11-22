
 <?php
session_start();

if (isset($_POST['otp'])) {
    // User entered an OTP, let's verify it
    $entered_otp = $_POST['votp'];

    if ($entered_otp == $_SESSION['veotp']) {
        // OTP is correct, you can proceed with further actions
        echo "<Script type='text/javascript'>alert('your payment is successful')</script>";
        
        echo"
        <script>
        document.location.href='../index.php';
        </script>";
    } else {
        // OTP is incorrect, handle the error
        echo "<Script type='text/javascript'>alert('invaild otp')</script>";
        echo"
        <script>
        document.location.href='../template/payment.php';
        </script>";
        
    }
}
    ?>