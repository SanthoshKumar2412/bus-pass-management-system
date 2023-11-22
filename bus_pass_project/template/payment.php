<?php
session_start();
include("../plugins/database.php");
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// Check if the user is logged in
$loggedIn = isset($_SESSION['email']);


if (!$loggedIn) {
    header("Location: user_login.php");
    exit();
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/application.css">
</head>
<body>
    <section id="payment" class="header">
    <nav>
                <div class="logo">
                    <div class="icon">
                    <i class="fa fa-bus" aria-hidden="true" id="icon"></i>
                    </div>
                    <div class="heading">
                  <h1>city<span>pass</span></h1>
                   </div>
                </div>
                <div class="nav-app">
                    <ul>
                     <li><a href="../index.php">home</a></li>
                     <li><a href="user_view.php">view pass</a></li>
                     <li><a href="renew.php">renew pass</a></li>
                     <li><a href="../index.php">status</a></li>
                     <li><a href="../index.php">about</a></li>
                     
                    </ul>
                </div>
                <div class="logins">
        <?php if ($loggedIn) { ?>
            <!-- If logged in, display logout button -->
            <form action="" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        <?php } else { ?>
            <!-- If not logged in, display login button -->
            <button onclick="navigateToLoginPage()">Login</button>
            <script>
                function navigateToLoginPage() {
                    window.location.href = "user_login.php";
                }
            </script>
        <?php } ?>
    </div>
            </nav>
        </div>
        <div class="container" id="paycon">
             <div class="app" id="payapp">
                
                <form action="../plugins/send.php" method="POST">
                    <div class="title">
                        <h3>payment</h3>
                        </div>
                        <div class="pay-det">
                            <div class="input-box">
                                <label for="iname" >name on card</label>
                                <input type="text" placeholder="name" name="cname" autocomplete="off" required>
                            </div>
                            <div class="input-box">
                                <label for="iplace">credit card number</label>
                                <input type="text" placeholder="0000 0000 0000 0000" name="cno" autocomplete="off" required>
                            </div>
                            <div class="input-box">
                                <label for="fplace">exp month</label>
                                <input type="text" placeholder="01" name="exmon" autocomplete="off" required>
                            </div>
                            <div class="input-box">
                                <label for="fplace">exp year</label>
                                <input type="text" placeholder="1993" name="exyear" autocomplete="off" required>
                            </div>
                            <div class="input-box">
                                <label for="fplace">cvv</label>
                                <input type="text" placeholder="000" name="cvv" autocomplete="off" required>
                            </div>
                        <div class="input-box">
                            <label for="amount">amount</label>
                            <input type="text" placeholder="2000" name="amount" autocomplete="off" required>
                        </div>
                        <div class="input-box" id="pay-col">
                                <label for="iname" >email</label>
                                <input type="email" placeholder="name" name="mail" autocomplete="off" required>
                            </div>
                        <div class="input-box">
                        <label for="amount">click</label>
                            <input type="submit"  name="send" value="get">
                        </div>
                    </div>
</form>
  <form action="../plugins/testing.php" method="post">
                    <div class="pay-det1">
                        <div class="input-box">
                            <label for="amount">enter otp</label>
                            <input type="text" placeholder="123456"name="votp" autocomplete="off" required>
                        </div>
                        </div>
                    <div class="sbtn">
                        <button type="submit" name="otp">pay</button>
                        </div>
</form>
 

             </div>
             </div>
        </div>
    </section>