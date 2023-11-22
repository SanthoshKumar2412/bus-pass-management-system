<?php
session_start();
include("../plugins/database.php");

// Handle logout request
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
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
    <link rel="stylesheet" href="../css/userpass.css">
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
                <div class="nav-app">
                    <ul>
                     <li><a href="../index.php">home</a></li>
                     <li><a href="#header">view pass</a></li>
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
        <div class="container" id="pass-details">
            <div class="cont">
                <div class="pass-head">
                    <h1>status</h1>
                </div>
                <div class="search_main">
                    <form method="POST">
                    <div class="search_form">
                    <label for="suser">enter your pass Id</label>
                   <input type="text" placeholder="user id" name="passid">
                   </div>
                   <div class="btn">
                   <button type="submit" name="submit">search</button>
                    </div>
                     </div>


        </div>
        <div class="result">
            <table class="table">
                <?php
                  if (isset($_POST['submit'])) {
                                $passId = $_POST['passid'];
                                 $sql = "SELECT application.id, application.uname,application.fromplace, application.toplace,application.passtype,application.validdate,application.aname,application.appphoto,payment.amount,payment.currentdate,payment.status FROM application INNER JOIN payment ON application.id=payment.id and payment.passId = '$passId'" ;
                                 $result=mysqli_query($con,$sql);
                                if($result){
                                    if($num=mysqli_num_rows($result)>0){
                                         $row=mysqli_fetch_assoc($result);
                    echo "<tr ><th colspan='3' class='tit'>city pass</th></tr>";
                   echo "<tr> <th>passid</th><td>".$row["id"]."</td><td rowspan='4'>
                   <img src='data:appphoto;base64,{$row["appphoto"]}' alt='' width='120px' height='120px'></td></tr>";
                   echo   "<tr> <th>name</th><td>".$row["uname"]."</td> </tr>";
                   echo    "<tr><th>fromplace</th><td>".$row["fromplace"]."</td></tr>";
                   echo      "<tr> <th>toplace</th>  <td>".$row["toplace"]."</td></tr>";
                   echo  " <tr> <th>amount</th> <td>".$row["amount"]."</td> </tr>";
                   echo  "<tr><th>valid date</th><td>".$row["validdate"]."</td></tr>";
                   echo"</table>";

            //     <tr>
            //         <th>name</th>
            //         <td>santhosh</td>
            //     </tr>
            //   <tr><th>passid</th><td>".$row["id"]."</td><td rowspan="4"><img src="" alt="" width="120px" height="120px"></td></tr>
            //   <tr><th>name</th><td>".$row["uname"]."</td></tr>
            // <tr><th>fromplace</th><td>".$row["fromplace"]."</td></tr>
            // <tr><th>toplace</th><td>".$row["toplace"]."</td></tr>
            // <tr><th>amount</th><td>".$row["amount"]."</td></tr>
            // <tr><th>valid date</th><td>".$row["validdate"]."</td></tr>


            // </table>
        } else {
            echo "<h2>No result</h2>";
        }  
        }
    }
        ?>
        </div>
    </section>
</body>
</html>