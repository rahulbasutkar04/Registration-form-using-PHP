<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
     
        <form action="login.php" method="post">
            <div class="formgroup">
                <input type="Email" placeholder="Enter Email:" name="email">
            </div>

            <div class="formgroup">
                <input type="password" placeholder="Enter password:" name="pass">
            </div>
            <div class="formbtn">
                  <input type="submit" value="login" name="login">
            </div>
        </form>
    </div>
</body>
</html> -->

<?php
  session_start();
 if(isset($_SESSION["user"]))
 {
    header("Location:index.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php
         if(isset($_POST["login"]))
         {
             $email=$_POST["email"];
             $pass=$_POST["pass"];
             require_once "database.php";
             $sql="SELECT * FROM users WHERE email='$email' ";
             $result=mysqli_query($conn,$sql);
             $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
             if($user)
             {
                 if(password_verify($pass,$user["password"]))
                 {
                    session_start();
                    $_SESSION["user"]="yes";
                     header("Location:index.php");
                     die();
 
 
                 }
                 else
                 {
                     echo "<h3>Password Does not matches</h3>";
                 }
 
             }
             else
             {
                 echo "<h3>Email Does not Exiest please do Register</h3>";
             }
         }
    
        ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter Email" name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter Password" name="pass">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Login" class="btn btn-primary btn-block" name="login">
                            </div>
                        </form>

                        <div>
                            <p>Not Registered Yet? <a href="registration.php">click here</a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</body>
</html>
