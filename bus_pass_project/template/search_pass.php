<?php
 include("../plugins/database.php");
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
            <li class="active"><a href="search_pass.php">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>view user</span>
            </a></li>
            <li><a href="status.php">
                <i class="fa-solid fa-user-check"></i>
                <span>status</span>
            </a></li>
            <li><a href="edit_pass.php">
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
                <a href="">home</a> / <a href="">status</a>
            </div>
            <div class="profile">
                <a href=""><i class="fa-solid fa-user"></i></a>
            </div>
        </div>
        <div class="container">
            <div class="search_main">
                <form method="POST">
                <div class="search_form">
                <label for="suser">view user details</label>
               <input type="text" placeholder="user id" name="passid">
               </div>
               <div class="btn">
               <button type="submit" name="submit">search</button>
                </div>
</form>
            </div>
        <div class="search_table">
            <table><?php
                if (isset($_POST['submit'])) {
                    $passId = $_POST['passid'];
                    $sql = "SELECT application.id, application.uname,application.fromplace, application.toplace,application.passtype,application.validdate,payment.amount,payment.currentdate,payment.status FROM application INNER JOIN payment ON application.id=payment.id and payment.passId = '$passId'" ;
                    $result=mysqli_query($con,$sql);
                    if($result){
                        if($num=mysqli_num_rows($result)>0){
                            echo '<tr id="r1">
                    <th id="t1">s.no</th>
                    <th>name</th>
                    <th>from</th>
                    <th>to</th>
                    <th>applied date</th>
                    <th>expired date</th>
                    <th>amount</th>
                    <th>pass type</th>
                </tr>';
           while($row=mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row["id"]."</td>
                    <td>".$row["uname"]."</td>
                    <td>".$row["fromplace"]."</td>
                    <td>".$row["toplace"]."</td>
                    <td>".$row["currentdate"]."</td>
                    <td>".$row["validdate"]."</td>
                    <td>".$row["amount"]."</td>
                    <td>".$row["passtype"]."</td></tr>";
                  echo"</table>";
                        }
                    }
                        else{
                            echo "<h2>no result</h2>";
                        }  
                        
                    }
                  
                
                
                else{
                    echo "no result";
                }
            }
                $con->close();
                ?>
                    
                </tr>
            </table>
        </div>
    </div>
</html>