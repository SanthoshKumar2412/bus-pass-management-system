<?php
 include("../plugins/database.php");
 
// Process approval or rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $appId = $_POST['appId'];
        // Define a prefix for the pass ID (e.g., "PASS")
$prefix = "CITYPASS";

// Generate a timestamp (e.g., current timestamp)
$timestamp = time();

// Generate a random component (e.g., a random number or alphanumeric string)
$random = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// Combine the components to create a unique pass ID
$passID = $prefix . $timestamp . $random;

// Output the unique pass ID
        $select = "UPDATE payment SET status = 'Approved', passId='$passID' WHERE id = $appId";
        $result=mysqli_query($con,$select);
        echo "<script>alert('approved');</script>";
        header("Location:status.php");
    } elseif (isset($_POST['reject'])) {
        $appId = $_POST['appId'];
        $select = "UPDATE payment SET status = 'Rejected' WHERE id = $appId";
        $result=mysqli_query($con,$select);
        echo "<script>alert('rejected');</script>";
        echo 'window.location.href="status.php"';
    }

  
  
}
// Retrieve and display applications
$query = "SELECT application.id, application.uname,application.fromplace, application.toplace,payment.amount,payment.currentdate,payment.status FROM application INNER JOIN payment ON application.id=payment.id "  ;
$apps = $con->query($query);

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
            <li><a href="search_pass.php">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>view user</span>
            </a></li>
            <li class="active"><a href="status.php">
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
            <div class="status-main">
                <table>
                    <tr id="r1">
                        <th id="t1">s.no</th>
                        
                        <th>name</th>
                        <th>from</th>
                        <th>to</th>
                        <th>amount</th>
                        <th>date</th>
                        <th>status</th>
                        
                        <th id="t2">action</th>
                    </tr>
                    <?php foreach ($apps as $app): ?>
                        <tr>
                        <td><?php echo $app['id']; ?></td>
                        <td><?php echo $app['uname']; ?></td>
                        <td><?php echo $app['fromplace']; ?></td>
                        <td><?php echo $app['toplace']; ?></td>
                        <td><?php echo $app['amount']; ?></td>
                        <td><?php echo $app['currentdate']; ?></td>
                        <td><?php echo $app['status']; ?></td>
               
                        <td>
                        <form action="" method="post">
    <input type="hidden" name="appId" value="<?php echo $app['id']; ?>">
    <button type="submit" name="approve" id="approve"><i class='fa-solid fa-thumbs-up'></i> Approval</button>
</form>
<form action="" method="post">
    <input type="hidden" name="appId" value="<?php echo $app['id']; ?>">
    <button type="submit" name="reject" id="reject"><i class='fa-solid fa-circle-xmark'></i> Reject</button>
</form>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                </div>
                </div>
            </div>
    </div>
</html>