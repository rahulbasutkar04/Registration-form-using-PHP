
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
    <title>Registration form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php


            if(isset($_POST["submit"])){
                $fullname=$_POST["fullname"];
                $email=$_POST["Email"];
                $pass=$_POST["password"];
                $cpass=$_POST["cpassword"];
                $errors=array();
                $pass_hash=password_hash($pass,PASSWORD_DEFAULT);
    
                if(empty($fullname)  OR empty($email) OR empty($pass) OR empty($cpass) )
                {
                    array_push($errors,"All fields are required");
                }
                if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                {
                    array_push($errors,"Email is not valid");
                }
                if(strlen($pass)<8)
                {
                    array_push($errors,"password must be 8 character long");
                }
                if($pass!=$cpass)
                {
                    array_push($errors,"Passowrd not matches");
                }
                require_once "database.php";
                $sql="SELECT * FROM users WHERE email='$email'";
                $result =mysqli_query($conn,$sql);
                $rowcount=mysqli_num_rows($result);
                if($rowcount>0)
                {
                    array_push($errors,"Email Already Exists");
                }
    
                if(count($errors)>0)
                {
                    foreach($errors as $errors)
                    {
                        echo "<div> $errors</div>";
                    }
                }
                else{
                    
                    $sql="INSERT INTO users(fullname,email,password) VALUES(?,?,?)";
                    $stmt=mysqli_stmt_init($conn);
                    $preparestmt=mysqli_stmt_prepare($stmt,$sql);
    
                    if($preparestmt)
                    {
                        mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$pass_hash);
                        mysqli_stmt_execute($stmt);
                        echo "<h3>YOU ARE REGISTERED SUCCESSFULLY</h3>";
    
    
                        
                    }
                    else{
                        die("Something went wrong");
                    }
                }
            }
            
        ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="registration.php" method="post">
                            <div class="form-group">
                                <input type="text" name="fullname" class="form-control" placeholder="Fullname">
                            </div>
                            <div class="form-group">
                                <input type="email" name="Email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Register" name="submit" class="btn btn-primary btn-block">
                            </div>
                        </form>

                        <div>
                            <p>Aleready Register? <a href="login.php">Login here</a></p>

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
