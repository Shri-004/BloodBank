<!DOCTYPE html>
<html>
<head>
    <title>Blood Bank Management System</title>
    <meta charset="UTF-8">
    <meta name="description" content="This is a blood dontation Website">
    <meta name="author" content="ShriKumaran,Anu Cyril Saju,Swati Anandan">
    <meta name="view-port" content="width=device-width initial-height=1.0">
    <meta http-equiv="refresh" content="1900">
    <link rel="stylesheet" type="text/css" href="recipienthome.css">
</head>
<body>
<nav>
    <img src="homepagelogo.png" height="70px">
    <label><b>Life Blood Bank Management System</b></label>
    <ul>
    <li><a href="bloodbank.php">Go Back</a></li>
    </ul>
</nav>
<!-- establishing the php connection -->
<?php 
  session_start();
?>
<?php 
    $mysql_hostname = "localhost";
    $mysql_password = "";
    $mysql_user = "root";
    $mysql_database = "bbms";
    $bd = mysqli_connect($mysql_hostname,$mysql_user,$mysql_password) or die("Could not connect database");
    mysqli_select_db($bd,$mysql_database) or die("Cannot select database");
    //echo"database connection success";
    $a = $_SESSION['name'];
    // echo "The name of the blood bank is ".$a;
    $sql = "SELECT * FROM bloodrequest WHERE bb_username = '$a'";
    $query = mysqli_query($bd,$sql);
    if(mysqli_num_rows($query)!=0)
    {
        $tab = "<center><div class='container'>
        <table border='1' style='margin-left:200px;'>
            <tr>
                <th colspan='5' style='color:red;font-size:40px'>Requests</th>
            </tr>
            <tr>
                <th>Recipient Name</th>
                <th>Blood Group</th>
            </tr>
            ";
        $i = 1;
        while($row = mysqli_fetch_row($query))
        {
            //creating an html table
            $tab = $tab."<tr><td>".$row[0]."</td><td>".$row[2]."</td></tr>";
            // $tab = $tab."<td><button id='btn-$i' onclick='request(id)'>Request Blood</button></td></tr>";
            $i++;
        }
        $tab = $tab."</table></div></center>";
        echo $tab;
        
    }
?>
<?php
//Start a new session
//session_start();
//Set the session duration for 5 seconds
$duration = 1800;
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
    
    //echo "New session is created.<br/>";
}
else
    echo "Current session exists.<br/>";  
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
?>
<div class="footer" style="height:40px">
    <p>&#169; Designed and Developed by Students of SCOPE</p>
</div>
<script>
    function request(id)
    {
        var btn = document.getElementById(id);
        console.log(btn);
        console.log("requested");
        btn.innerText="Requested";
        btn.style.background = "green";
    }
</script>
</body>
</html>


