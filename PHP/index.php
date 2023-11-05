<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "scribe");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel = "stylesheet" href = "https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">  
</head>
<body>
    <div class = "container py-5">
    <div class ="row">
    <table id="example" class="content-table" tyle="width:100%">
        <thead>
          <tr>
            <th>Book Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Year Published</th>
            <th>Availability</th>
          </tr>
        </thead>
        <tbody>
		<?php
        $result = mysqli_query($conn, "SELECT book_name,author,genres,rating,availability FROM book");
        while($row = mysqli_fetch_assoc($result)){
            echo 
            "<tr>
                <td class='px-4 py-2 text-center border'>$row[book_name]</td>
                <td class='px-4 py-2 text-center border'>$row[author]</td>
                <td class='px-4 py-2 text-center border'>$row[genres]</td>
                <td class='px-4 py-2 text-center border'>$row[rating]</td>
                <td class='px-4 py-2 text-center border'>$row[availability]</td>
            </tr>";
         }
         ?>
            <tr>
                <td class="px-4 py-2 text-center border">The Great Gatsby</td>
                <td class="px-4 py-2 text-center border">F. Scott Fitzgerald</td>
                <td class="px-4 py-2 text-center border">Drama</td>
                <td class="px-4 py-2 text-center border">4.5</td>
                <td class="px-4 py-2 text-center border">Available</td>
            </tr>
        </tbody>
      </table>
    </div>
</div>
    <script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src = "./app2.js"></script>
</body>
</html>