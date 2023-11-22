<?php
 include("../plugins/database.php");
 if($_SERVER['REQUEST_METHOD']=="POST"){
    $fplace=$_POST['fplace'];
    $tplace=$_POST['tplace'];
    $passcategory=$_POST['passcategory'];
    $ptype=$_POST['ptype'];
    $rate=$_POST['rate'];
    if(!empty($fplace)&&!empty($tplace) &&!empty($passcategory) &&!empty($ptype)&&!empty($rate))
{
    $query="insert into passdetails(fromplace,toplace,passcat,passtype,rate) values('$fplace','$tplace','$passcategory','$ptype','$rate')";
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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/admin.css">
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
            <li><a href="../admin.php">
                <i class="fa-solid fa-house-chimney"></i>
                <span>dashboard</span>
            </a></li>
            <li ><a href="search_pass.php">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>view user</span>
            </a></li>
            <li><a href="status.php">
                <i class="fa-solid fa-user-check"></i>
                <span>status</span>
            </a></li>
            <li class="active"><a href="edit_pass.php">
                <i class="fa-solid fa-money-check"></i>
                <span>edit pass amount</span>
            </a></li>
            <li><a href="renew_admin.php">
                <i class="fa-solid fa-user-check"></i>
                <span>renewal status</span>
            </a></li>
            <li class="logout"><a href="admin_login.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>logout</span>
            </a></li>
        </ul>
    </div>
    <div class="wapper">
        <div class="header">
            <div class="navbar">
                <a href="">home</a> / <a href="">edit pass amount</a>
            </div>
            <div class="profile">
                <a href=""><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
        <div class="container">
            <div class="edit_main">
                <h3>pass details</h3>
                <form method="POST">
                    <div class="input_box">
                        <label for="category">from</label>
                        <select name="fplace" autocomplete="off" required>
                            <option value="none" selected disabled hidden>--Select--</option> 
                            <option value="Kanakapura">Kanakapura</option>
                            <option value="Harohalli">Harohalli</option>
                            <option value="Channapatna">Channapatna</option>
                            <option value="Ramangara">Ramangara</option>
                            <option value="Magadi">Magadi</option>
                            <option value="Chikkaballapura">Chikkaballapura</option>
                            <option value="Bengaluru">Bengaluru</option>
                        </select>
                    </div>
                    <div class="input_box">
                        <label for="category">to</label>
                        <select name="tplace" autocomplete="off" required>
                            <option value="none" selected disabled hidden>--Select--</option> 
                            <option value="Kanakapura">Kanakapura</option>
                            <option value="Harohalli">Harohalli</option>
                            <option value="Channapatna">Channapatna</option>
                            <option value="Ramangara">Ramangara</option>
                            <option value="Magadi">Magadi</option>
                            <option value="Chikkaballapura">Chikkaballapura</option>
                            <option value="Bengaluru">Bengaluru</option>
                        </select>
                    </div>
                    <div class="input_box">
                        <label for="category">pass category</label>
                        
                            <select name="passcategory" autocomplete="off" required>
                                <option value="none" selected disabled hidden>--Select--</option> 
                                <option value="monthly">monthly</option>
                                <option value="quaterly">quaterly</option>
                                <option value="half yearly">half yearly</option>
                                <option value="yearly">yearly</option>
                                
                            </select>
                        
                    </div> 
                <div class="input_box">
                    <label for="category">pass type</label>
                    <select name="ptype" autocomplete="off" required>
                        <option value="none" selected disabled hidden>--Select--</option> 
                        <option>regular</option>
                        <option>student</option>
                    </select>
                </div>
                <div class="input_box">
                    <label for="">pass rates</label>
                    <input type="text" name="rate" id="" placeholder="123 /-" autocomplete="off" required>
                </div>
             
                <div class="btn">
                    <button type="submit" name="submit">submit</button>
                    </div>

                </form>

             
        </div>
    </div>
</html>