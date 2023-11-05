<?php 
    require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/profile.css">
    <script defer src="../JavaScript/bootstrap.bundle.min.js"></script>
    <script defer src="../JavaScript/profile.js"></script>
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
                        <div class="row overview-row">
                            <div class="col-lg-4 static-info">
                                <p class="static-text">Name</p>
                                <p class="static-text">Email</p>
                                <p class="static-text">ID Number</p>
                                <div class="col-lg-3">
                                <a href='#'>
                                <input class="view-button" type="submit" value="View QR">
                                </a>
                                </div>
                                <div id="myModal" class="modal2">
                                    <div class="modal-content2">
                                        <span class="close" id="closeModal">&times;</span>

                                        <div class="row qr-text d-flex justify-content-center">
                                            <div class="col-lg-12 d-flex justify-content-center">
                                                <p id="qr-name" class="qr-sign"><?php echo $_SESSION["first_name"], " " ,$_SESSION["last_name"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="row qr-image d-flex justify-content-center">
                                            <div class="col-lg-3 d-flex justify-content-center">
                                                <img src="" id="qrcode">
                                            </div>
                                        </div>

                                        <!-- Borrow button with ID for styling -->
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-3 d-flex justify-content-center">
                                                <a download href="https://api.qrserver.com/v1/create-qr-code/?size=[250]x[250]&data=<?php echo $_SESSION["first_name"], " " ,
                                                $_SESSION["last_name"]; ?>&download=1">
                                                <input class="download-button format" type="submit" value="DOWNLOAD QR">
                                                </a>
                                            </div>
                                        </div>
                                    
                                        <!-- Remove button with ID for styling 
                                        <button id="remove-button">Remove</button>-->
                                  
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 dynamic-info">
                                <p><?php echo $_SESSION["first_name"], " " ,$_SESSION["last_name"]; ?></p>
                                <p><?php echo $_SESSION["email"]; ?></p>
                                <p><?php echo $_SESSION["IDnumber"]; ?></p>
                            </div>
                        </div>       
                    </div>
                </div>
                <div class="profile-form profile-form-right col-lg-6 border-0 shadow">
                    <div class="col-lg-11 profile-frame">
                        <div class="col-lg-12">
                            <p class="overview">Attendance History</p>
                            <hr>
                        </div>
                        <div class = "container attendance">
                            <div class ="row">
                            <table id="example" class="content-table table-borderless" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class='px-4 py-2 text-center'>Date</th>
                                        <th class='px-4 py-2 text-center'>Time in</th>
                                        <th class='px-4 py-2 text-center'>Time out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $accID = $_SESSION["accountID"];
                                    $result = mysqli_query($conn, "SELECT accountID, entry_time, exit_time
                                    FROM attendance
                                    WHERE accountID = '$accID'
                                    ORDER BY entry_time DESC
                                    LIMIT 5;");
                                    while($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>
                                        <td class='px-4 py-2 text-center'>$row[accountID]</td>
                                        <td class='px-4 py-2 text-center'>$row[entry_time]</td>
                                        <td class='px-4 py-2 text-center'>$row[exit_time]</td>
                                    </tr>";
                                    }     
                                ?>
                                </tbody>
                            </table>
                            <a href='attendance.php'>
                                <input class="view-all format" type="submit" value="View all">
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row profile">
            <div class="profile-container col-lg-12 pt-0">
                <div class="profile-form profile-form-left col-lg-6 border-0 shadow">
                    <div class="col-lg-11 profile-frame">
                        <div class="col-lg-12">
                            <p class="overview">Borrowed Books</p>
                            <hr>
                        </div>
                        <div class = "container borrowed-books">
                            <div class ="row">
                            <table id="example" class="content-table table-borderless" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class='px-4 py-2 text-center'>Date</th>
                                        <th class='px-4 py-2 text-center'>Date of Return</th>
                                        <th class='px-4 py-2 text-center'>Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $accID = $_SESSION["accountID"];
                                    $result = mysqli_query($conn, "SELECT borrow_date,deadline,bookID
                                    FROM borrowed_book
                                    WHERE borrowerID = '$accID'
                                    ORDER BY borrow_date DESC
                                    LIMIT 5;");

                                    while($row = mysqli_fetch_assoc($result)){

                                        $booknumber = $row["bookID"];
                                        $result2 = mysqli_query($conn, "SELECT book_name
                                        FROM book
                                        WHERE bookID = '$booknumber';");

                                        $row2 = mysqli_fetch_assoc($result2);

                                        echo "<tr>
                                            <td class='px-4 py-2 text-center'>$row[borrow_date]</td>
                                            <td class='px-4 py-2 text-center'>$row[deadline]</td>
                                            <td class='px-4 py-2 text-center'>$row2[book_name]</td>
                                        </tr>";
                                    }     
                                ?>
                                </tbody>
                            </table>
                            <a href='borrowedbooks.php'>
                                <input class="view-all format" type="submit" value="View all">
                            </a>
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




