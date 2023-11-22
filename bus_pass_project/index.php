<?php
session_start();
include("plugins/database.php");

// Handle logout request
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

// Check if the user is logged in
$loggedIn = isset($_SESSION['email']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
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
                     <li><a href="#header">home</a></li>
                     <li><a href="template/user_view.php">view pass</a></li>
                     <li><a href="template/renew.php">renew pass</a></li>
                     <li><a href="#status">status</a></li>
                     <li><a href="#about">about</a></li>
                     
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
             <div class="wapper">
                <h1>welcome to city<span>pass</span></h1>
                <p>use a city pass for travel safe and comfortable journey</p>
                <button onclick="navigateToAnotherPage()" >apply now</button>
                <script>
        function navigateToAnotherPage() {
            // Use JavaScript to change the location (navigate) to another PHP page
            window.location.href = "template/application.php";
        }
    </script>
             </div>
        </div>
    </section>
    <section class="pass-details">
        <div class="cont">
        <div class="pass-head">
            <h1>pass details</h1>
            <!-- <p>hrlsllllll</p> -->
        </div>
        <div class="pass-tab">
            <table class="table">
                <tr>
                    <th>s.no</th>
                    <th>from</th>
                    <th>to</th>
                    <th>pass category</th>
                    <th>pass type</th>
                    <th>pass rates (Rs.)</th>
                </tr>
                <?php

$sql="SELECT * from passdetails";
$result=$con->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    echo "<tr><td>".$row["sno"]."</td><td>".$row["fromplace"]."</td><td>".$row["toplace"]."</td><td>".$row["passcat"]."</td><td>".$row["passtype"]."</td><td>".$row["rate"]."</td></tr>";
  }echo"</table>";
}
else{
    echo "no result";
}

?>
</table>
        </div>
        </div>
    </section>
    <section class="pass-details" id="status">
        <div class="cont">
        <div class="pass-head">
            <h1>status</h1>
        </div>
        <div class="search_main">
            <form method="POST">
            <div class="search_form">
            <label for="suser">enter your aadher no</label>
           <input type="text" placeholder="user id" name="aadharnno">
           </div>
           <div class="btn">
           <button type="submit" name="submit">search</button>
            </div>
            
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $aadher = $_POST['aadharnno'];
            $sql = "SELECT application.id, application.aadharnno, payment.passId FROM application INNER JOIN payment ON application.id=payment.id and application.aadharnno=$aadher ";
            $result=mysqli_query($con,$sql);
            if ($result) {
                if ($num = mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $err = "Your pass is successfully approved: " . $row['passId'] ;
                    }
                } else {
                    $err = "your pass is rejected";
                }
            } else {
                $err = "Error in query execution: " . mysqli_error($con);
            }
        
            mysqli_close($con);
        }
        ?>
<div class="error">
    <?php echo isset($err) ? $err : ''; ?>
</div>
        </div>
    </section>
    <section id="about">
    <div class="container-about">
    <div class="dd">

    </div>
    <div class="qq">
        <h1>about us</h1>
        <p>The Bus Pass Management System is dedicated to streamlining and enhancing the efficiency of public transportation. Our team is committed to providing a user-friendly platform that simplifies the process of managing bus passes for both passengers and administrators.

With a focus on accessibility and convenience, our system allows passengers to easily purchase, renew, and manage their bus passes online. We prioritize security, ensuring that personal information is handled with the utmost care and confidentiality.
Our dedicated team of developers and transportation experts collaborates to continually improve the system's functionality, incorporating user feedback to deliver a seamless experience. Whether you're a daily commuter or a transportation authority, our goal is to make the bus pass management process smooth and hassle-free.
We believe in the power of technology to transform public transportation, making it more reliable and accessible for everyone. Join us in our journey towards efficient and modernized bus pass management.

</p>
        <button type="button">read more</button>
    </div>
    </div>
    <div class="footer">
       <div class="title">
        <p> <a href="">&#169;2023 city pass</a></p>
       </div>
       <div class="policy">
        <ul>
            <li><a href="#">privacy policy</a></li>
            <li><a href="#">terms & condition</a></li>
        </ul>
       </div>
    </div>
</section>
</body>
</html>