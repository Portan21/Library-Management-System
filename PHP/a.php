<?php
date_default_timezone_set('Asia/Manila'); // Set the time zone to Philippines
$currentDateTime = date('Y-m-d H:i:s');

date_default_timezone_set('Asia/Manila'); // Set the time zone to Philippines
$currentDate = new DateTime();

$conn = mysqli_connect("scribelibrary.mysql.database.azure.com", "scribeproject", "Adminako123!", "scribelibrary");

$accID = $_POST['email'];

// Be sure to set up your SQL $conn variable here
$sql = "SELECT name, librarianID FROM lib_acc WHERE email = '$accID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$librarianId = $row['librarianID'];
echo json_encode($row['librarianID']);

$sql = "SELECT lib_entry FROM lib_attendance WHERE librarianID = '$librarianId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$duplicateEmail = mysqli_query($conn, "SELECT lib_entry FROM lib_attendance WHERE librarianID = '$librarianId' AND lib_exit IS NULL");
if(mysqli_num_rows($duplicateEmail) > 0){
    $sql = "UPDATE lib_attendance SET lib_exit = '$currentDateTime' WHERE librarianID = $librarianId AND lib_exit IS NULL";
    $result = mysqli_query($conn, $sql);
    echo json_encode("IF");
}
else {
    $sql = "INSERT INTO lib_attendance(librarianID, lib_entry) VALUES('$librarianId','$currentDateTime')";
    $result = mysqli_query($conn, $sql);
    echo json_encode("else");
}

// if ($row['lib_entry']) {
    
// } else {
//     $sql = "INSERT INTO lib_attendance(librarianID, lib_entry) VALUES('$librarianId','$currentDateTime')";
//     $result = mysqli_query($conn, $sql);
// }

// $sql = "INSERT INTO lib_attendance(librarianID, lib_entry) VALUES('$librarianId','$currentDateTime')";
// $result = mysqli_query($conn, $sql);

if ($row) {
    // If a row is found, echo the data as JSON
    echo json_encode($row);
} else {
    // If no matching record found, echo appropriate message
    echo json_encode(['error' => 'No matching record found']);
}
?>