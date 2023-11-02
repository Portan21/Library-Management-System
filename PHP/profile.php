<?php 
require 'config.php';

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
    <link rel="stylesheet" href="../CSS/profile.css">
    <script defer src="../JavaScript/bootstrap.bundle.min.js"></script>
    <script defer src="../JavaScript/javascript.js"></script>
    <title>Profile</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row profile">

            <div class="profile-container profile-container-top col-lg-12 pb-4">
                <div class="profile-form profile-form-left col-lg-6 border-0 shadow">
                    <div class="col-lg-11 profile-frame">
                        <div class="col-lg-12">
                            <p class="overview">Overview</p>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 static-info">
                                <p class="static-text">Name</p>
                                <p class="static-text">Username</p>
                                <p class="static-text">ID Number</p>
                            </div>
                            <div class="col-lg-8">
                                <p><?php echo $_SESSION["email"]; ?></p>
                                <p>Username</p>
                                <p>ID Number</p>
                            </div>
                        </div>       
                    </div>
                </div>
                <div class="profile-form profile-form-right col-lg-6 border-0 shadow">
                    <div class="col-lg-11 profile-frame">
                        <div class="col-lg-12">
                            <p class="overview">Overview</p>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 static-info">
                                <p class="static-text">Name</p>
                                <p class="static-text">Username</p>
                                <p class="static-text">ID Number</p>
                            </div>
                            <div class="col-lg-5">
                                <p>Name</p>
                                <p>Username</p>
                                <p>ID Number</p>
                            </div>
                            <div class="col-lg-5">
                                <p>Name</p>
                                <p>Username</p>
                                <p>ID Number</p>
                            </div>
                        </div>       
                    </div>
                </div>
            </div>

            <div class="profile-container col-lg-12 pt-0">
                <div class="profile-form profile-form-left col-lg-6 border-0 shadow">
                    <div class="col-lg-11 profile-frame">
                        <div class="col-lg-12">
                            <p class="overview">Overview</p>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 static-info">
                                <p class="static-text">Name</p>
                                <p class="static-text">Username</p>
                                <p class="static-text">ID Number</p>
                            </div>
                            <div class="col-lg-8">
                                <p>Name</p>
                                <p>Username</p>
                                <p>ID Number</p>
                            </div>
                        </div>       
                    </div>
                </div>
                <div class="profile-form profile-form-right col-lg-6 border-0 shadow">
                    <div class="col-lg-11 profile-frame">
                        <div class="col-lg-12">
                            <p class="overview">Overview</p>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 static-info">
                                <p class="static-text">Name</p>
                                <p class="static-text">Username</p>
                                <p class="static-text">ID Number</p>
                            </div>
                            <div class="col-lg-8">
                                <p>Name</p>
                                <p>Username</p>
                                <p>ID Number</p>
                            </div>
                        </div>       
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>




