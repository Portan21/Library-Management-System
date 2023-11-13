<?php 
require 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> 
</head>
<body>
    <div class = "container py-5">
    <div class ="row">
    <table id="example" class="content-table" style="width:100%">
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
                ORDER BY entry_time DESC;");
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
    </div>
    <script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src = "../JavaScript/index.js"></script>
    <script src = "../JavaScript/app2.js"></script>
</body>
</html>