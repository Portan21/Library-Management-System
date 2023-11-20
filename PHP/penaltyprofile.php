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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Penalty</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> 
</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="landing.php">SCRIBE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-lg-0 ms-auto">

            <li class="nav-item">
            <a class="nav-link" href="catalogs.php">Catalog</a>
            </li>
	    <?php
        $acctype = $_SESSION["typeID"];
	    if($acctype != 4){
	    echo"
            <li class='nav-item'>
            <a class='nav-link' href='approval.php'>Approval</a>
            </li>

            <li class='nav-item'>
            <a class='nav-link' href='request.php'>Request</a>
            </li>

            <li class='nav-item'>
            <a class='nav-link' href='borrowed.php'>Borrowed</a>
            </li>

            <li class='nav-item'>
            <a class='nav-link' href='penalty.php'>Penalty</a>
            </li>";
	    }

	    ?>

            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
    </nav>
    <div class = "container py-5">
    <div class ="row">
    <table id="example" class="content-table" style="width:100%">
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
    </div>
    <script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src = "../JavaScript/index.js"></script>
    <script src = "../JavaScript/app2.js"></script>
</body>
</html>