<?php
session_start();
 include("../plugins/database.php");
 if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    if(!empty($email)&&!empty($pass) && !is_numeric($email)){
        $query="SELECT * FROM signup where email='$email' limit 1";
        $result=mysqli_query($con,$query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            if ($user_data['password'] == $pass) {
                $_SESSION['email'] = $email;
                    header("location:../index.php");
                    exit();
                }
            }
        }
        echo "<Script type='text/javascript'>alert('wrong username or password')</script>";
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
                <input type="submit" value="admin login" onclick="navigateToAnotherPage()">
                <script>
        function navigateToAnotherPage() {
            // Use JavaScript to change the location (navigate) to another PHP page
            window.location.href = "admin_login.php";
        }
    </script>
            </div>
        </nav>
    <div class="wapper">
        <div class="log-form">
         <form action="" method="POST">
            <h1>login</h1>
            <div class="input-box">
                <input type="email" placeholder="username" name="email" autocomplete="off" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="password" name="pass" autocomplete="off" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="rem">
                <label ><input type="checkbox">remember me</label>
                <a href="forget.php">forgot password</a>
            </div>
            <button type="submit" class="btn">login</button>
            <div class="reg-link">
                <p>Don't have an account? <a href="signup.php">sign up</a></p>
            </div>
         </form>
        </div>
    </div>
</section>
</body>
</html>