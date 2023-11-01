<?php 
require 'config.php';
if(!empty($_SESSION["accountID"])){
    header("Location: catalog.php");
}

if(isset($_POST["login"])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM account WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
        if(password_verify($password, $row["password"])){
            $_SESSION["login"] = true;
            $_SESSION["accountID"] = $row["accountID"];
            $_SESSION["idnumber"] = $row["idnumber"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["last_name"] = $row["last_name"];
            $_SESSION["typeID"] = $row["typeID"];

            header("Location: catalog.php");
        }
        else{
            echo "<script> alert('Wrong Password'); </script>";
        }
    }
    else{
        echo "<script> alert('Email Not Registered'); </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <script defer src="js/javascript.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row login">
            <div class="login-side col-lg-3">
            </div>
                <div class="login-form col-lg-6 rounded-5 border-0 shadow">
                <div class="col-lg-8 login-frame">

                <div class="row logo-container d-flex justify-content-center mt-4">
                    <div class="col-lg-3 d-flex justify-content-center">
                        <img class="logo" src="Pictures/user log 2.png" alt="logo">
                    </div>
                </div>

                <div class="row login-text d-flex justify-content-center">
                    <div class="col-lg-3 d-flex justify-content-center">
                        <p class="login-sign">Login</p>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-lg-3 d-flex justify-content-center">
                        <form action="" method="post" autocomplete="off">
                            <label class="input-text" for="username">Email</label><br>
                            <input class="input-username format" type="text" id="email" name="email" required><br>

                            <label class="input-text" for="pwd">Password</label><br>
                            <input class="input-password format" type="password" id="password" name="password" required>

                            <input class="checkbox" type="checkbox" id="remember" name="remember" value="remember">
                            <label class="remember format-remember" for="remember">Remember me</label>

                            <a class="forgot-password format-forgot" href="#"  href="#">Forgot Password?</a>

                            <button class="login-button format" type="submit" value="Login" id="login" name="login">Login</button>
                        </form>
                    </div>
                </div>

                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-lg-6 d-flex justify-content-center">
                        <a class="create-format" href="register.php">Create your account →</a>
                    </div>
                </div>

            </div>
        </div>
            <div class="login-side col-lg-3 mt-5">
            </div>
        </div>
    </div>
</body>
</html>



<!--<div class="col-lg-8 login-frame rounded-5">


<div class="row  login">
        <div class="col-lg-2 login-space">
            1
        </div>
        <div class="col-lg-8 login-frame justify-content-center">
            <div class="row logo container">
                <div id="logo" class="col-lg-1">
                    Logo
                </div>
            </div>
            <div class="row login-text">
                <div id="login-text" class="col-lg-1 justify-content-center">
                    Login
                </div>
            </div>
            <div class="row username-text">
                <div id="username-text" class="col-lg-1">
                    <form>
                        <label for="username">Username:</label><br>
                        <input type="text" id="username" name="username"><br>
                        <label for="pwd">Password:</label><br>
                        <input type="password" id="password" name="password">
                        <input type="submit" value="Login">
                      </form>
                </div>
            </div>
            <div class="row">
                <div id="username-input" class="col-lg-1">
                    
                </div>
            </div>
            <div class="row">
                <div id="password-text" class="col-lg-1">
                    
                </div>
            </div>
            <div class="row">
                <div id="password-input" class="col-lg-1">
                    
                </div>
            </div>
            <div class="row">
                <div id="remember-forgot" class="col-lg-1">
                    
                </div>
            </div>
            <div class="row"></div>
                <div id="login-button" class="col-lg-1">
                    
                </div>
            </div>
            <div class="row">
                <div id="create-account-button" class="col-lg-1">
                    
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-2 login-space">
            3
        </div>
    </div>    
-->

<!--
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="row card-body">
                            <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                              </svg>
                            <p class="login-text">Login</p>
                            <form action="">
                                <p>Username</p>
                                <input type="text" id="username" class="form-control my-3 py-0" name="username"><br>
                                <p>Password</p>
                                <input type="password" id="password" class="form-control my-3 py-0" name="password"><br>
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary">Login</button>
                                    <a href="#" class="nav-link">Create your account (arrow)</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->