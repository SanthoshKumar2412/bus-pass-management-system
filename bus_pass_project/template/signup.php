<?php
 session_start();
 include("../plugins/database.php");
 if($_SERVER['REQUEST_METHOD']=="POST"){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $pnum=$_POST['pnum'];
    $pass=$_POST['pass'];
    $conpass=$_POST['conpass'];
    if(!empty($email)&&!empty($pass) && !is_numeric($email))
{
    $query="insert into signup(firstname,lastname,email,phonenumber,password,conpassword) values('$fname','$lname','$email','$pnum','$pass','$conpass')";
    mysqli_query($con,$query);
    echo "<Script type='text/javascript'>alert('successfully Register')</script>";
}
else{
    echo "<Script type='text/javascript'>alert('enter all the details')</script>";
}
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/logins.css">
</head>
<body>
    <section id="header" class="header">
        <nav>
            <div class="logo">
                <div class="icon">
                <i class="fa fa-bus" aria-hidden="true" id="icon"></i>
                </div>
                <div class="heading">
              <h1>city<span>pass</span></h1>
               </div>
            </div>
            <div class="logins">
                <input type="submit" value="user login">
                <input type="submit" value="admin login">
                <button><i class="fa fa-bars" aria-hidden="true"></i></button>
            </div>
        </nav>
    <div class="wapper">
        <div class="sign-form">
         <form action="" method="POST">
            <h1>sign up</h1>
            <div class="input-box">
                <input type="text" placeholder="first name" name="fname" autocomplete="off" required>  
            </div>
            <div class="input-box">
                <input type="text" placeholder="last name" name="lname" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="email" placeholder="email" name="email" autocomplete="off" required>
            </div>
           
            <div class="input-box">
                <input type="text" placeholder="phone number" name="pnum" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="password" name="pass" autocomplete="off" required>
                
            </div>
            <div class="input-box">
                <input type="password" placeholder="conform password" name="conpass" autocomplete="off" required>
            </div>
            <button type="submit" class="sign-btn" name="submit">sign up</button>
            <div class="reg-link">
                <p>already have an account? <a href="user_login.php">log in</a></p>
            </div>
         </form>
         
        </div>
    </div>
</section>
</body>
</html>