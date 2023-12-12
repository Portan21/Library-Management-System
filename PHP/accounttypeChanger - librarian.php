<?php
$conn = mysqli_connect("scribelibrary.mysql.database.azure.com", "scribeproject", "Adminako123!", "scribelibrary");

$ID = $_POST['ID'];

$result = mysqli_query($conn, "SELECT typeID FROM lib_acc WHERE librarianID = '$ID'");
$row = mysqli_fetch_assoc($result);
if(mysqli_num_rows($result) > 0 && $row['typeID'] == 2){
    $sql = "UPDATE lib_acc SET typeID = 3 WHERE librarianID = '$ID'";
    $result = mysqli_query($conn, $sql);
}
else{
    $sql = "UPDATE lib_acc SET typeID = 2 WHERE librarianID = '$ID'";
    $result = mysqli_query($conn, $sql);
}
?>