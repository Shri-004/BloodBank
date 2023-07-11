<html>
    <head>
    <title>Blood Bank Login</title>
    <meta charset="UTF-8">
    <meta name="description" content="This is a blood dontation Website">
    <meta name="author" content="ShriKumaran,Anu Cyril Saju,Swati Anandan">
    <meta name="view-port" content="width=device-width initial-height=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="login.js">
    </script>
</head>
<body>
    <nav>
        <img src="homepagelogo.png" height="70px">
        <label><b>Life Blood Bank Management System</b></label>
    </nav>
    <center>
        <div>
            <form action="<?php $_php_self ?>" method="post">
                <h2>Login</h2>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username"><br><br>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password"><br><br>
                <!-- <input type="checkbox" name="remember_me" id="remember_me"> -->
                <!-- <label for="remember_me">Remember me</label><br><br> -->
                <a href="bloodbankregister.php">Want to be a new BloodBank?</a><br><br>
                <input type="submit" id="submit-btn" name="submit-btn" value="Login"><br>
            </form>
        </div>

    </center>
    <?php 
           // $bb_name="hello";$bb_name;$bb_pass;$bb_a1;$bb_a2;$bb_b1;$bb_b2;$bb_o1;$bb_o2;$bb_ab1;$bb_ab2;
            //database connectivity
            if(isset($_POST["submit-btn"]))
            {
                $bbusername = $_POST["username"];
                $bbpassword = $_POST["password"];
                $mysql_hostname = "localhost";
                $mysql_password = "";
                $mysql_user = "root";
                $mysql_database = "bbms";
                $bd = mysqli_connect($mysql_hostname,$mysql_user,$mysql_password) or die("Could not connect database");
                mysqli_select_db($bd,$mysql_database) or die("Cannot select database");
                // echo"database connection success";
                $sql = "SELECT * FROM bloodbank WHERE bb_username='$bbusername'  AND bb_pass='$bbpassword'";
                $query = mysqli_query($bd,$sql);
                
                if(mysqli_num_rows($query)!=0)
                {
                    echo "The no of rows are ".mysqli_num_rows($query);
                    $row =mysqli_fetch_row($query);
                    echo(implode(" ",$row));
                    echo"username and password valid";
                    session_start();
                    //storing the bloodbank variables
                    $_SESSION["username"] = $row[0];
                    $_SESSION["name"] = $row[1];
                    $_SESSION["pass"] = $row[2];
                    $_SESSION["a1"] = $row[3];
                    $_SESSION["a2"] = $row[4];
                    $_SESSION["b1"] = $row[5];
                    $_SESSION["b2"] = $row[6];
                    $_SESSION["o1"] = $row[7];
                    $_SESSION["o2"] = $row[8];
                    $_SESSION["ab1"] = $row[9];
                    $_SESSION["ab2"] = $row[10];
                    //echo "<br>Varaibles are $row[0] $row[1] $row[2] $row[3]";
                    header("location:bloodbank.php");
                }
                else{
                    echo "<script>alert('Invalid userid or password')</script>";
                //    echo"<script> swal('Error','Inalid Userid or password','error')</script>";
                }
            }
        ?>

</body>
</html>