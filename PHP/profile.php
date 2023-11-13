<?php 

    require 'config.php';

    if(empty($_SESSION["accountID"])){
        header("Location: login.php");
    }
    else{
        $id = $_SESSION["accountID"];
    }

    date_default_timezone_set('Asia/Manila'); // Set the time zone to Philippines
$currentDateTime = date('Y-m-d H:i:s');

date_default_timezone_set('Asia/Manila'); // Set the time zone to Philippines
$currentDate = new DateTime();

if(isset($_POST["ret"])){
    $borrowID = $_POST["borrowID"];

    $bdateres = mysqli_query($conn, "SELECT borrow_date FROM borrowed_book WHERE borrowID = $borrowID");
    while($rowbdate = mysqli_fetch_assoc($bdateres)){
        $borrowdate = new DateTime($rowbdate["borrow_date"]);

        $interval = $borrowdate->diff($currentDate);

        $months = $interval->y * 12 + $interval->m;
        // Access the difference in days, hours, minutes, and seconds
        $days = $interval->d;

        $totaldays = ($months * 30) + $days;
        $totalpenalty = $totaldays * 10;
        
        
        $insquery = "INSERT INTO returned_book (bookID, borrowerID, librarianID, borrow_date, return_date, penalty_paid)
        SELECT bookID, borrowerID, $id, borrow_date, '$currentDateTime', '$totalpenalty'
        FROM borrowed_book
        WHERE borrowID = $borrowID";
        if(mysqli_query($conn, $insquery)){
            $delquery = "DELETE FROM borrowed_book WHERE borrowID = $borrowID";
            if(mysqli_query($conn, $delquery)){
            }
            else{
                echo"<script>alert('DELETING ERROR');</script>";
            }
        }

        //echo"<script>alert('Total Penalty: ₱$totalpenalty.00');</script>";
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
                                    LIMIT 2;");
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
                                        <th class='px-4 py-2 text-center'>Deadline</th>
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
                                    LIMIT 2;");

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
                            <p class="overview">Penalty</p>
                            <hr>
                        </div>
                        <div class = "container attendance">
                            <div class ="row">
                            <table id="example" class="content-table table-borderless" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class='px-4 py-2 text-center'>Book Name</th>
                                        <th class='px-4 py-2 text-center'>Days Late</th>
                                        <th class='px-4 py-2 text-center'>Penalty Fee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $result = mysqli_query($conn, "SELECT borrowID, a.first_name AS bf_name, a.last_name AS bl_name, ac.first_name AS lf_name, ac.last_name AS ll_name, book_name, deadline, bb.borrow_date AS borrow_date FROM borrowed_book bb
                                    INNER JOIN book b on bb.bookID = b.bookID
                                    INNER JOIN account a on bb.borrowerID = a.accountID
                                    INNER JOIN account ac on bb.librarianID = ac.accountID
                                    WHERE deadline < '$currentDateTime' AND bb.borrowerID = $id
                                    ORDER BY deadline DESC
                                    LIMIT 1");
                                    while($row = mysqli_fetch_assoc($result)){
                                        $brwdate = new DateTime($row["borrow_date"]);
                                        
                                        $intrvl = $brwdate->diff($currentDate);
                                        $mnt = $intrvl->y * 12 + $intrvl->m;
                                        $dys = $intrvl->d;
                        
                                        $totday = ($mnt * 30) + $dys;
                                        $totpen = $totday * 10;
                                    echo "<tr>
                                        <td class='px-4 py-2 text-center'>$row[book_name]</td>
                                        <td class='px-4 py-2 text-center'>$totday days</td>
                                        <td class='px-4 py-2 text-center'>₱$totpen.00</td>
                                    </tr>";
                                    }     
                                ?>
                                </tbody>
                            </table>
                            <a href='penaltyprofile.php'>
                                <input class="view-all format" type="submit" value="View all">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>var qrText = document.getElementById('qr-name').innerHTML;


qrcode.src="https://api.qrserver.com/v1/create-qr-code/?size=[250]x[250]&data=" + qrText;
    
// Get the modal and its elements
const modal = document.getElementById("myModal");

// Get all book buttons
const bookButtons = document.querySelectorAll(".view-button");

// Attach click event to each book button
bookButtons.forEach((button) => {
  button.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent the default behavior of anchor tags
        
    // Show the modal
    modal.style.display = "flex";
  });
});

// Close the modal when the 'x' is clicked or when clicking outside of it
const closeModal = document.getElementById("closeModal");
closeModal.addEventListener("click", () => {
  modal.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});

</script>
</body>
</html>




