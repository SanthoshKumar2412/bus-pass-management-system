<?php
session_start();
include("../plugins/database.php");
if($_SERVER['REQUEST_METHOD']=="POST"){

$name=$_POST["name"];
$pass=$_POST["pass"];
if(!empty($name)&&!empty($pass)){
   $sql="SELECT * FROM admin where name='$name' limit 1";
   $result=mysqli_query($con,$sql);
   if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    if ($user_data['password'] == $pass) {
       $_SESSION['name']=$name;
       header("Location:../admin.php");
       exit(); 
   }
   else{
       echo "<p class='err'>invalid user</p>";
   }
}
}
 else{
   echo "<p class='err'>please enter all the details</p>";
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
        </nav>
    <div class="wapper">
        <div class="log-form">
         <form action="admin_login.php" method="post">
            <h1>admin login</h1>
            <div class="input-box">
                <input type="text" placeholder="admin id" id="name" name="name"  autocomplete="off" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="password" id="password" name="pass" autocomplete="off" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            
            <button type="submit" class="btn" name="submit">login</button>
            
         </form>
      
        </div>
    </div>
   
</section>

</body>
</html>
</html>