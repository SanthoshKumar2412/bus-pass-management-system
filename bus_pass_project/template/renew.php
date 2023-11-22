<?php
session_start();
// Assuming you've established a database connection
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $username = $_POST['username'];
    $passId = $_POST['pass_id'];

$currentDate = new DateTime(); // Get the current date
$pcat="monthly";

switch ($pcat) {
    case "monthly":
        $currentDate->add(new DateInterval('P1M')); // Add 1 month
        break;
    default:
        echo "Invalid payment frequency selected.";
        exit;
}
//Format and display the calculated expiration date
$formattedExpirationDate = $currentDate->format('Y-m-d');
    // Performing the update query
    $updateQuery = "UPDATE `application` SET `validdate` = '$formattedExpirationDate' WHERE cusId= '$passId'";

    if (mysqli_query($con, $updateQuery)) {
        echo "<Script type='text/javascript'>alert('your pass is renewed successfully')</script>";
        
        echo"
        <script>
        document.location.href='../index.php';
        </script>";
    } else {
        echo "<Script type='text/javascript'>alert('invaild pass id')</script>";
        echo"
        <script>
        document.location.href='../template/renew.php';
        </script>";
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
             <div class="app " id="payapp">
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                    <h3>renew pass</h3>
                    <div class="app-det">
                        <div class="input-box">
                            <label for="iplace">name</label>
                            <input type="text" placeholder="username" name="username" autocomplete="off" required>
                        </div>
                        <div class="input-box">
                            <label for="fplace">pass id</label>
                            <input type="text" placeholder="passid" name="pass_id" autocomplete="off" required>
                        </div>
                        <div class="input-box">
                            <label for="fplace">from</label>
                            <input type="text" placeholder="majestic" autocomplete="off" required>
                        </div>
                        <div class="input-box">
                            <label for="fplace">to</label>
                            <input type="text" placeholder="hosur" autocomplete="off" required>
                        </div>
                        <div class="input-box">
                            <label for="pcategory">pass type</label>
                            <select name="ptype" id="pcategory" autocomplete="off" required>
                                <option value="--select--">--select--</option>
                                <option value="regular">regular</option>
                                <option value="student">student</option>
                            </select>
                        </div>
                        </div>
                    <div class="sbtn">
                        <button>submit</button>
                        </div>
                </form>
             </div>
             </div>
        </div>
    </section>