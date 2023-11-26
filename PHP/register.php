<?php 
require 'config.php';

if(!empty($_SESSION["accountID"])){
    header("Location: catalog.php");
}

if(isset($_POST["regis"])){
    $email = trim($_POST["email"]);
    $name = "";
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    
    // Verify the email ending
    if (substr($email,-15) == "@adamson.edu.ph") {
        // Extract the name part
        $namePart = substr($email, 0, -15);

        // Replace dots with spaces and capitalize the first letter of each word
        $name = ucwords(str_replace('.', ' ', $namePart));
    }
    else{
        $name = false;
    }


    if ($name != false) {
        
        //SENDING OF OTP


    } else {
        echo "<script> alert('NOT ADU EMAIL'); </script>";
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/register.css">
    <script defer src="../JavaScript/bootstrap.bundle.min.js"></script>
    <script defer src="../JavaScript/javascript.js"></script>
    <title>Register</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row register">
            <div class="register-side col-lg-3">
            </div>
            <div class="register-form col-lg-6 rounded-5 border-0 shadow">
                <div class="col-lg-8 register-frame">
                    
                    <div class="row logo-container d-flex justify-content-center mt-4">
                        <div class="col-lg-3 d-flex justify-content-center">
                            <img class="logo" src="../Pictures/user log 2.png" alt="logo">
                        </div>
                    </div>

                    <div class="row register-text d-flex justify-content-center">
                        <div class="col-lg-3 d-flex justify-content-center">
                            <p class="register-sign">REGISTER</p>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-3 d-flex justify-content-center">
                            <form action="" method="post" autocomplete="off">
                                <label class="input-text" for="email">EMAIL ADDRESS</label><br>
                                <input class="input-email format" type="text" id="email" name="email" required>
                                <label class="input-text" for="password">PASSWORD</label><br>
                                <input class="input-password format" type="password" id="password" name="password" required>
                                <label class="input-text" for="confirmpassword">CONFIRM PASSWORD</label><br>
                                <input class="input-confirmpassword format" type="password" id="confirmpassword" name="confirmpassword" required>
                                <button class="submit-button format" type="submit" value="SUBMIT" id="regis" name="regis">SUBMIT</button>
                              </form>
                        </div>
                        
                        <div class="row d-flex justify-content-center mb-4">
                                <div class="col-lg-6 d-flex justify-content-center mt-2">
                                   
                                    <a class="create-format" href="login.php">Already Have An Account? Login</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="register-side col-lg-3">
            </div>
        </div>
    </div>
</body>
</html>