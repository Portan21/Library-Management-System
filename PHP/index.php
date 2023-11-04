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
    <link rel="stylesheet" href="main.css">
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
            <th>Rating</th>
            <th>Availability</th>
          </tr>
        </thead>
        <tbody>
		<?php
        $result = mysqli_query($conn, "SELECT book_name,author,genres,rating,availability,description FROM book ORDER BY bookID ASC");
        while($row = mysqli_fetch_assoc($result)){
          $bookName = htmlspecialchars($row['book_name']);
          $description = htmlspecialchars($row['description']);
          echo "<tr>
              <td class='px-4 py-2 text-center border'><a href='#' class='book-button' data-description='$description'>$bookName</a></td>
              <td class='px-4 py-2 text-center border'>$row[author]</td>
              <td class='px-4 py-2 text-center border'>$row[genres]</td>
              <td class='px-4 py-2 text-center border'>$row[rating]</td>
              <td class='px-4 py-2 text-center border'>$row[availability]</td>
          </tr>";
          
         }
         ?>
        </tbody>
      </table>
    </div>
</div>
	<!-- The modal container -->
<div id="myModal" class="modal2">
  <div class="modal-content2">
    <span class="close" id="closeModal">&times;</span>
    <h2 id="modal-title">Book Title</h2>
    <p id="modal-author">Author</p>
    <p id="modal-genres">Genres</p>
    <p id="modal-rating">Rating</p>
    <p id="modal-availability">Availability</p>
    <p id="modal-description">Description</p>
    <!-- Borrow button with ID for styling -->
    <button id="borrow-button">Borrow</button>

    <!-- Remove button with ID for styling 
    <button id="remove-button">Remove</button>-->

  </div>
</div>
	<script src = "./script.js"></script>
    <script src = "https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src = "./app2.js"></script>
</body>
</html>