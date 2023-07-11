<!DOCTYPE html>
<html>
    <head>
        <title>Delete Blood Bank</title>
        <meta charset="UTF-8">
        <meta name="description" content="This is a blood dontation Website">
        <meta name="author" content="ShriKumaran,Anu Cyril Saju,Swati Anandan">
        <meta name="view-port" content="width=device-width initial-height=1.0">
        <link rel="stylesheet" type="text/css" href="donor_history.css">
        
    </head>
    <body>
    <nav>
        <img src="homepagelogo.png" height="70px">
        <label><b>Life Blood Bank Management System</b></label>
        <ul>
        <li><a href="viewbb.php">View Blood Banks</a></li>
        <li><a href="deletebb.php">Delete Blood Banks</a></li>
        </ul>
        </nav>
        <center>
        <form action="<?php $_php_self ?>" method="post">
            <h1>Enter the Details</h1><br>
            <label>Blood Bank Name</label>
            <input type="text" name="bname"><br><br>
            <input type="submit" name="btn"value="submit">
        </form>
        </center>
        <?php 
        if(isset($_POST['btn']))
        {
            $mysql_hostname = "localhost";
            $mysql_password = "";
            $mysql_user = "root";
            $mysql_database = "bbms";
            $bd = mysqli_connect($mysql_hostname,$mysql_user,$mysql_password) or die("Could not connect database");
            mysqli_select_db($bd,$mysql_database) or die("Cannot select database");
            $bn=$_POST["bname"];
            $sql = "DELETE FROM bloodbank WHERE bb_name='$bn'";
            if(mysqli_query($bd,$sql))
            {
                echo "Deleted successfully!";
            }
        }
        ?>
       
        <div class="footer" >
            <p>&#169; Designed and Developed by Students of SCOPE</p>
        </div>
    </body>
</html>