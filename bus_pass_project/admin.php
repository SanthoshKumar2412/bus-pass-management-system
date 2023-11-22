<?php
session_start();
include("plugins/database.php");

if (!isset($_SESSION['name'])) {
    header("Location:template/admin_login.php"); // Redirect if the user is not logged in
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <div class="icon">
                <i class="fa fa-bus" aria-hidden="true" id="icon"></i>
                </div>
                <div class="heading">
              <h1>city<span>pass</span></h1>
               </div>
        </div>
        <ul class="main">
            <li class="active"><a href="../bus_pass_project/admin.php">
                <i class="fa-solid fa-house-chimney"></i>
                <span>dashboard</span>
            </a></li>
            <li><a href="template/search_pass.php">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>view user</span>
            </a></li>
            <li><a href="template/status.php">
                <i class="fa-solid fa-user-check"></i>
                <span>status</span>
            </a></li>
            <li><a href="template/edit_pass.php">
                <i class="fa-solid fa-money-check"></i>
                <span>edit pass amount</span>
            </a></li>
            <li><a href="template/renew_admin.php">
                <i class="fa-solid fa-user-check"></i>
                <span>renewal status</span>
            </a></li>
            <li class="logout"><a href="template/admin_logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>logout</span>
            </a></li>
        </ul>
    </div>
    <div class="wapper">
        <div class="header">
            <div class="navbar">
                <a href="">home</a> / <a href="">dashboard</a>
            </div>
            <div class="profile">
                <a href=""><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
        <div class="container">
            <div class="con-main">
                <div class="cards">
                <div class="card" id="c1">
                    <div class="title">
                        <h1>15</h1>
                        <p>total pass</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
                <div class="card" id="c2">
                    <div class="title">
                        <h1>5</h1>
                        <p>pending pass</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
                <div class="card" id="c3">
                    <div class="title">
                        <h1>7</h1>
                        <p>student pass</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
                <div class="card" id="c4">
                    <div class="title">
                        <h1>3</h1>
                        <p>regular pass</p>
                    </div>
                    <div class="icons">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
                </div>
            </div>

    </div>
  
</body> 
</html>