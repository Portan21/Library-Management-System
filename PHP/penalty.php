<?php
require 'config.php';
if(empty($_SESSION["accountID"])){
    header("Location: login.php");
}
else{
    $id = $_SESSION["accountID"];
}

if($_SESSION["typeID"] == 4){
    header("Location: catalog.php");
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
    <title>Penalties</title>
    <link rel="stylesheet" href="../CSS/approval.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">  
</head>
<body>
    <div class = "container py-5">
        <div class ="row">
        <table id="example" class="table table-borderless" style="width:100%">
            <thead>
            <tr>
                <th class='text-uppercase'><h3>Overdue borrow</h3></th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            $result = mysqli_query($conn, "SELECT borrowID, a.first_name AS bf_name, a.last_name AS bl_name, ac.first_name AS lf_name, ac.last_name AS ll_name, book_name, deadline, bb.borrow_date AS borrow_date FROM borrowed_book bb
            INNER JOIN book b on bb.bookID = b.bookID
            INNER JOIN account a on bb.borrowerID = a.accountID
            INNER JOIN account ac on bb.librarianID = ac.accountID
            WHERE deadline < '$currentDateTime'");
            while($row = mysqli_fetch_assoc($result)){
                $brwdate = new DateTime($row["borrow_date"]);
                
                $intrvl = $brwdate->diff($currentDate);
                $mnt = $intrvl->y * 12 + $intrvl->m;
                $dys = $intrvl->d;

                $totday = ($mnt * 30) + $dys;
                $totpen = $totday * 10;

                echo 
                "<tr>
                    <td class='px-4 py-2'>
                        <div class='container'>
                            <div class='row border border-secondary rounded mt-1 mb-1'>
                                <div class='col-5 text-break mt-1 mb-1 '>
                                        <h3 class='text-uppercase mb-0'>$row[bf_name] $row[bl_name]</h3>
                                        <a>$row[book_name]</a><br>
                                </div>
                                
                                <div class='col-3 text-break mt-1 mb-1'>
                                        <h5 class='text-uppercase mb-0 text-danger'>$totday days late</h5>
                                        <h5 class='text-danger'>Penalty fee: ₱$totpen.00</h5><br>
                                </div>

                                <div class='col-4 d-flex justify-content-end align-items-center'>
                                    <div>
                                        <form action='' method='post' autocomplete='off'>
                                            <input type='hidden' id='borrowID' name='borrowID' value='$row[borrowID]'>
                                            <button type='submit' class='btn btn-danger' onclick='return confirmReturn()' id='ret' name='ret'>PAID AND RETURNED</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </td>
                </tr>";
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
    <script>
    function confirmReturn() {
        return confirm('Press "OK" to confirm the book return. Press "Cancel" otherwise.');
    }
    </script>
    <script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src = "../JavaScript/app2.js"></script>
</body>
</html>