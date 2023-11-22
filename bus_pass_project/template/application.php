<?php
session_start();
///234567890
include("../plugins/database.php");

// Handle logout request
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


//
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $_SESSION['uname']=$_POST['uname'];
    $_SESSION['fname']=$_POST['fname'];
    $_SESSION['dob']=$_POST['dob'];
    $_SESSION['gender']=$_POST['gender'];
    $_SESSION['age']=$_POST['age'];
    $_SESSION['aadhar']=$_POST['aadhar'];
    $_SESSION['mobno']=$_POST['mobno'];
    $_SESSION['area']=$_POST['area'];
    $_SESSION['mail']=$_POST['mail'];
    $_SESSION['pcode']=$_POST['pcode'];
    $_SESSION['ptype']=$_POST['ptype'];
    switch($_SESSION['ptype']){
        case "student": header("Location:student.php");
        break;
    
    case "regular":header("location:regular.php");
    break;
    }


    exit;
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
    <section id="header1" class="header">
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
                    window.location.href = "template/user_login.php";
                }
            </script>
        <?php } ?>
    </div>
            </nav>
        </div>
        <div class="container">
             <div class="app">
                
                <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <h3>applicant details</h3>
                    <div class="app-det">
                    <div class="input-box">
                        <label for="uname" >name</label>
                        <input type="text" placeholder="username" name="uname" autocomplete="off" required>
                    </div>
                    <div class="input-box">
                        <label for="fname">father/guardian name</label>
                        <input type="text" placeholder="fathername" name="fname" autocomplete="off" required>
                    </div>
                    <div class="input-box">
                        <label for="dob">date of birth</label>
                        <input type="date" name="dob" autocomplete="off" required>
                    </div>
                    <div class="input-box">
                        <label for="gender">gender</label>
                        <select name="gender" id="pcategory" autocomplete="off" required>
                            <option value="--select--">--select--</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="age">age</label>
                        <input type="text" placeholder="00" name="age" autocomplete="off" required>
                    </div>
                    <div class="input-box">
                        <label for="anum">aadhar no</label>
                        <input type="text" placeholder="0000 0000 0000 0000" name="aadhar" autocomplete="off" required>
                    </div>

                    <div class="input-box">
                        <label for="mobileno">mobile no</label>
                        <input type="text" placeholder="00000 00000" name="mobno" autocomplete="off" required>
                    </div>
                    <div class="input-box " id="box1">
                        <label for="address">address</label>
                        <textarea id="address" cols="30" rows="6" name="area" autocomplete="off" required></textarea>
                    </div>

                    <div class="input-box">
                        <label for="email">email</label>
                        <input type="email" placeholder="abc@gmail.com" name="mail" autocomplete="off" required>
                    </div>
                    <div class="input-box">
                        <label for="pincode">pincode</label>
                        <input type="text" placeholder="000 000" name="pcode" autocomplete="off" required>
                    </div>
                    <div class="input-box">
                        <label for="pcategory">pass type</label>
                        <select name="ptype" id="pcategory" autocomplete="off" required>
                        <option value="none" selected disabled hidden>--Select--</option> 
                            <option value="regular">regular</option>
                            <option value="student">student</option>
                        </select>
                    </div>
               
                
                        </div>
                        <div class="btn">
                        <button type="submit">next</button>
                        </div>
                </form>
             </div>
             </div>
        </div>
    </section>