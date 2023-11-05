<?php 
require 'config.php';
if(empty($_SESSION["accountID"])){
    header("Location: login.php");
}

if($_SESSION["typeID"] == 4){
    header("Location: catalog.php");
}

if(isset($_POST["regis"])){
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $sid = $_POST["sID"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $accounttype = $_POST["accountType"];

    $duplicateID = mysqli_query($conn, "SELECT IDnumber FROM account WHERE IDnumber = '$sid'");
    $duplicateIDapproval = mysqli_query($conn, "SELECT IDnumber FROM account_approval WHERE IDnumber = '$sid'");
    $duplicateEmail = mysqli_query($conn, "SELECT email FROM account WHERE email = '$email'");
    $duplicateEmailapproval = mysqli_query($conn, "SELECT email FROM account_approval WHERE email = '$email'");
    if(mysqli_num_rows($duplicateID) > 0 || mysqli_num_rows($duplicateIDapproval) > 0){
        echo "<script> alert('ID Has Already Been Taken'); </script>";
    }
    else if(mysqli_num_rows($duplicateEmail) > 0 || mysqli_num_rows($duplicateEmailapproval) > 0){
        echo "<script> alert('Email Has Already Been Taken'); </script>";
    }
    else{
        if($password == $confirmpassword){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insertquery = "INSERT INTO account (IDnumber, email, password, first_name, last_name, typeID) VALUES ('$sid', '$email', '$hashed_password', '$fname', '$lname', '$accounttype')";

            mysqli_query($conn,$insertquery);
            echo "<script> alert('Registration Successful!!'); </script>";
        }
        else{
            echo "<script> alert('Password Does Not Match'); </script>";
        }
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
    <title>Create Admin/Librarian Account</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row register">
            <div class="register-side col-lg-3">
            </div>
            <div class="register-form col-lg-6 rounded-5 border-0 shadow">
                <div class="col-lg-8 register-frame">

                    <div class="row register-text d-flex justify-content-center mt-2">
                        <div class="col-lg-8 d-flex justify-content-center">
                            <p class="register-sign text-center">CREATE LIBRARIAN ACCOUNT</p>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mb-5">

                        <div class="col-lg-3 d-flex justify-content-center">
                            <form action="" method="post" autocomplete="off">

                                <label class="input-text" for="firstname">FIRST NAME</label><br>
                                <input class="input-firstname format" type="text" id="firstname" name="firstname" required>

                                <label class="input-text" for="lastname">LAST NAME</label><br>
                                <input class="input-lastname format" type="text" id="lastname" name="lastname" required>

                                <label class="input-text" for="sID">ID NUMBER</label><br>
                                <input class="input-ID format" type="text" id="sID" name="sID" required>

                                <label class="input-text" for="email">EMAIL ADDRESS</label><br>
                                <input class="input-email format" type="text" id="email" name="email" required>

                                <label class="input-text" for="password">PASSWORD</label><br>
                                <input class="input-password format" type="password" id="password" name="password" required>

                                <label class="input-text" for="confirmpassword">CONFIRM PASSWORD</label><br>
                                <input class="input-confirmpassword format" type="password" id="confirmpassword" name="confirmpassword" required>

                                <label class="input-text" for="accounttype">ACCOUNT TYPE</label>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="accountType" id="accountType1" value="1">
                                <label class="form-check-label" for="accountType1"> Admin</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="accountType" id="accountType2" value="2">
                                <label class="form-check-label" for="accountType2"> Head Librarian</label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="accountType" id="accountType3" value="3" checked>
                                <label class="form-check-label" for="accountType3"> Librarian</label>
                                </div>

                                <button class="submit-button format" type="submit" value="SUBMIT" id="regis" name="regis" onclick='return confirmApprove()'>SUBMIT</button>
                            </form>
                        </div>
                        <div class="row d-flex justify-content-center">
                                <div class="col-lg-6 d-flex justify-content-center mt-2">
                                   
                                    <a class="create-format" href="catalogs.php">Back to Catalog</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="register-side col-lg-3">
            </div>
        </div>
    </div>
    
    <script>
    function confirmApprove() {
        return confirm('Press "OK" to proceed on creating the account. Press "Cancel" otherwise.');
    }
    </script>
</body>
</html>