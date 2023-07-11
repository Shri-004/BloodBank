<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blood Bank Management System</title>
    <meta charset="UTF-8">
    <meta name="description" content="This is a blood dontation Website">
    <meta name="author" content="ShriKumaran,Anu Cyril Saju,Swati Anandan">
    <meta name="view-port" content="width=device-width initial-height=1.0">
    <meta http-equiv="refresh" content="1900">
    <link rel="stylesheet" type="text/css" href="bloodbank.css">
</head>
<body>
<nav>
    <img src="homepagelogo.png" height="70px">
    <label><b>Life Blood Bank Management System</b></label>
    <ul>
    <li><a href="homepage.php">Go Back</a></li>
    <li><a href="viewrequests.php">View Requests</a></li>
    <li><a href="updaterepository.php">Update Repository</a>
    <li><a href="contactdonor.php">Contact Donors</a></li>
    
    </ul>
</nav>
<div id="main-container">
<center><?php echo $_SESSION['name']?></center>
<div class="grid-container">
    <div class="grid-item">
        <h2>A+</h2>
        <h2 class="no"><?php echo $_SESSION['a1']?></h2>
        <img src="blooddrop1.jpg" height="100">
    </div>
    <div class="grid-item">
        <h2>B+</h2>
        <h2 class="no"><?php echo $_SESSION['a2']?></h2>
        <img src="blooddrop1.jpg" height="100">
    </div>
    <div class="grid-item">
        <h2>A-</h2>
        <h2 class="no"><?php echo $_SESSION['b1']?></h2>
        <img src="blooddrop1.jpg" height="100">
    </div>
    <div class="grid-item">
        <h2>B-</h2>
        <h2 class="no"><?php echo $_SESSION['b2']?></h2>
        <img src="blooddrop1.jpg" height="100">
    </div>
    <div class="grid-item">
        <h2>O+</h2>
        <h2 class="no"><?php echo $_SESSION['o1']?></h2>
        <img src="blooddrop1.jpg" height="100">
    </div>
    <div class="grid-item">
        <h2>O-</h2>
        <h2 class="no"><?php echo $_SESSION['o2']?></h2>
        <img src="blooddrop1.jpg" height="100">
    </div>
    <div class="grid-item">
        <h2>AB+</h2>
        <h2><?php echo $_SESSION['ab1']?></h2>
        <img src="blooddrop1.jpg" height="100">
    </div>
    <div class="grid-item">
        <h2>AB-</h2>
        <h2 class="no"><?php echo $_SESSION['ab2']?></h2>
        <img src="blooddrop1.jpg" height="100">
    </div>
    
</div>
</div>
<!-- settin the session timer -->
<?php
//Start a new session
//session_start();
//Set the session duration for 5 seconds
$duration = 1900;
//Read the request time of the user
$time = $_SERVER['REQUEST_TIME'];
//Check the user's session exist or not
if (isset($_SESSION['LAST_ACTIVITY']) &&
   ($time - $_SESSION['LAST_ACTIVITY']) > $duration) {
    //Unset the session variables
    session_unset();
    //Destroy the session
    session_destroy();
    header("location:bloodbanklogin.php");
    // //Start another new session
    //session_start();
    
   // echo "New session is created.<br/>";
}
else
   // echo "Current session exists.<br/>";  
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
?>
<div class="footer">
    <p>&#169; Designed and Developed by Students of SCOPE</p>
</div> 
</body>
</html>


